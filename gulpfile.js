
// Required Plugins


const { src, dest, lastRun, series, parallel, watch } = require('gulp');
var fs = require('fs'),
    reload = require('require-reload')(require),
    packageJSON = require('./package.json'),
    browserSync = require('browser-sync').create(),
    del = require('del'),
    minimist = require('minimist'),
    gulpif = require('gulp-if'),
    cached = require('gulp-cached'),
    changed = require('gulp-changed'),
    pug = require('gulp-pug'),
    pugInheritance = require('gulp-pug-inheritance'),
    postcss = require('gulp-postcss'),
    sass = require('gulp-sass'),
    sassGlob = require('gulp-sass-glob'),
    cssnano = require('gulp-cssnano'),
    extReplace = require('gulp-ext-replace'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    svgSprite = require('gulp-svg-sprite'),
    ghPages = require('gulp-gh-pages'),
    sourcemaps = require('gulp-sourcemaps'),
    surge = require('gulp-surge');


// Setup Environment


var dist = 'dist/',
    base = './',
    min = '',
    production = false;

var options = minimist(process.argv.slice(2));

if (options.base) base = './';
if (options.min) min = '.min';
if (options.production) production = true;



// Compile Pug


var pugLocals = {
  base: base,
  min: min,
  gallery: []
};

function renameFile(file) {
  var name = file.replace('-', ' ')
  name = name.substring(0, name.indexOf('.'));

  return name;
}

function readGallery(dir, key, nest) {
  fs.readdir(dir, function(err, images) {
    if(err) return console.error(err);

    if(key == null) key = 'root';
    if(nest == null) nest = '';

    pugLocals.gallery[key] = [];

    for(var i in images) {
      if(fs.statSync(dir + '/' + images[i]).isDirectory()) {
        readGallery(dir + '/' + images[i], images[i], images[i] + '/');
      } else {
        var name = renameFile(images[i]);

        pugLocals.gallery[key].push({
          file: nest + images[i],
          name: name
        });
      }
    }
  });
}

function gallery(done) {
  pugLocals.gallery = {};

  readGallery('source/images/');

  done();
}

function compilePug() {
  return src([
    'source/pages/*.pug'
  ])
    .pipe(pug({
      locals: pugLocals,
      pretty: true
    }))
    .pipe(dest(dist))
    .pipe(gulpif(production, dest(dist)))
    .pipe(browserSync.stream());
}

function pugPages() {
  return src([
    'source/pages/*.pug'
  ])
    .pipe(changed(dist, {
      extension: '.html'
    }))
    .pipe(cached('pug'))
    .pipe(pugInheritance({
      basedir: 'source/pages',
      skip: 'node_modules'
    }))
    .pipe(pug({
      locals: pugLocals,
      pretty: true
    }))
    .pipe(dest(dist))
    .pipe(browserSync.stream());
}



// Compile Sass


function compileSass() {
  return src([
    'source/styles/*.scss',
    'source/styles/_*.scss'
  ])
    .pipe(sourcemaps.init())
    .pipe(sassGlob())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('.'))
    .pipe(dest(dist + 'css'))
    .pipe(browserSync.stream())
    .pipe(gulpif(production, postcss([
      require('autoprefixer')()
    ])))
    .pipe(gulpif(production, cssnano()))
    .pipe(gulpif(production, extReplace('.min.css')))
    .pipe(gulpif(production, dest(dist + 'css')))
    .pipe(gulpif(production, browserSync.stream()));
}


// Compile font


function compileFont() {
  return src([
    'source/styles/fonts/*'
  ])
    .pipe(dest(dist + 'css/fonts'));
}


// Compile JS


function compileJs() {
  return src([
    'source/scripts/vendor/*.js',
    'source/scripts/site/*.js'
  ])
    .pipe(concat('script.js'))
    .pipe(dest(dist + 'js'))
    .pipe(browserSync.stream())
    .pipe(gulpif(production, uglify({
      mangle: false
    })))
    .pipe(gulpif(production, extReplace('.min.js')))
    .pipe(gulpif(production, dest(dist + 'js')))
    .pipe(gulpif(production, browserSync.stream()));
}



// Optimize Images


function images() {
  return src('source/images/**/*')
    .pipe(changed(dist + 'images'))
    .pipe(imagemin())
    .pipe(dest(dist + 'images'))
    .pipe(browserSync.stream());
}



// Create Sprite


function sprite() {
  return src('source/icons/*.svg')
    .pipe(svgSprite({
      mode: {
        inline: true,
        symbol: {
          dest: dist
        }
      },
      svg: {
        xmlDeclaration: false,
        doctypeDeclaration: false,
        dimensionAttributes: false
      }
    }))
    .pipe(dest('.'))
    .pipe(browserSync.stream());
}



// Sync Changes


function runBrowserSync(done) {
  browserSync.init({
    logPrefix: packageJSON.name,
    ui: false,
    server: 'dist/',
    notify: {
      styles: {
        top: 'auto',
        bottom: '0',
        padding: '4px 8px',
        fontSize: '12px',
        borderBottomLeftRadius: '0'
      }
    }
  });

}

function reload(done) {
  browserSync.reload();

  done();
}



// Reset production


function reset(done) {
  try {
    packageJSON = reload('./package.json');
  } catch (e) {
    console.error("Failed to reload package.json! Error: ", e);
  }

  done();
}



// Clean Dist


function clean(done) {
  del([
    '*.html',
    'dist/**',
    '!dist',
    '!dist/svg',
    '!dist/svg/**',
    '!dist/css',
    '!dist/js',
  ]);

  done();
}

// Watch Files


function watchFiles() {
  watch(['package.json'], series(reset, series(
    images,
    sprite,
    compileFont,
    compileSass,
    compileJs,
    gallery,
    compilePug
  )));
  watch(['source/components/**/*.pug', 'source/masterpage/*.pug', 'source/pagelayout/*.pug'], series(compilePug));
  watch('source/pages/*.pug', series(pugPages));
  watch('source/components/**/*.scss', series(compileSass));
  watch('source/styles/**/*.scss', series(compileSass));
  watch('source/styles/_*.scss', series(compileSass));
  watch('source/scripts/**/*.js', series(compileJs));
  watch('source/images/**/*', series(images, gallery));
  watch('source/icons/*', series(sprite));
}


// Deploy to GitHub Pages
var gulp   = require('gulp');
var deploy = require('gulp-gh-pages');

gulp.task('deploy', function () {
  return gulp.src("./dist/**/*")
    .pipe(deploy())
});

// Task Sets


exports.compilePug = compilePug;
exports.compileSass = compileSass;
exports.compileFont = compileFont;
exports.compileJs = compileJs;

exports.clean = clean;

exports.build = series(
  images,
  sprite,
  compileFont,
  compileSass,
  compileJs,
  gallery,
  compilePug
);

exports.dev = parallel(
  watchFiles,
  runBrowserSync
);

exports.default = series(
  images,
  sprite,
  compileFont,
  compileSass,
  compileJs,
  gallery,
  compilePug,
  parallel(
    watchFiles,
    runBrowserSync
  )
);
