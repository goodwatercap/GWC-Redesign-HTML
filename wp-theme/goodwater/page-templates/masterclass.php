<?php
/**
 * The masterclass template file
 * Template Name: masterclass
 * Template Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 */
$article = get_query_var('article');
$fields = retrieve_contentful_details($article);
//example payload
// [{"releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","mainDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","authorImage":{"sys":{"type":"Link","linkType":"Asset","id":"Le1Nk1L9nLJ2acxRSKkF6"}},"authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","authorExternalUrl":"https:\/\/www.linkedin.com\/in\/mariyanurislamova\/","numberOfSessionsAndTotalTime":"14 - 24:24","sessions":[{"title":"Optimizing CAC","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/DXS2noNUUr5xuHwzIqxTL\/bf744010960d09fcb67af678843e1768\/Screenshot_2025-05-07_at_8.13.17_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082396875","timeSpan":"2:09"},{"title":"The Strategy","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/7mz9gsepNj3uvchWifUJLB\/efff07eee420b2ca44fd17246cf993ba\/Screenshot_2025-05-07_at_8.16.44_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082396990","timeSpan":"2:51"},{"title":"Getting Ads to Market at High Speed","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/4EcKhTOtzHxWaqeK40JcpH\/cfd92eb00685b147f4b6a4ea5f2ca2bf\/Screenshot_2025-05-07_at_8.18.25_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397157","timeSpan":"2:53"},{"title":"AI in Action","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/7fGigoMYg8JVhbYEQjlEnK\/3198dcd9ccb271bd1ee2d021b7870325\/Screenshot_2025-05-07_at_8.20.40_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397322","timeSpan":"2:50"},{"title":"Metrics","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/4kLYC5kEaBVzc1vKAmiA60\/16dbfa827ff19887e5db8f3603926250\/Screenshot_2025-05-07_at_8.22.33_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397486","timeSpan":"1:29"},{"title":"Key Takeaways","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/74QGL3x6Ukz1iLKXqbrTNm\/314fb8324d5b499002f463d655c948b4\/Screenshot_2025-05-07_at_8.24.01_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397564","timeSpan":"0:54"}]}]

if (empty($fields)) {
    wp_redirect('/');
    return;
}


get_header(); ?>

<!-- Banner Section -->
<?php get_template_part('template-parts/inner-page/banner',null,array('class'=>'banner--about')); ?>
<?php var_dump(json_encode($fields)) ?>
   
<?php get_footer(); ?>