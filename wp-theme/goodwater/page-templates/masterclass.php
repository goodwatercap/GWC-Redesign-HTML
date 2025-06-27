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
// {"releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","mainDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","categories":["AI","Marketing","Growth"],"authorImage":"\/\/images.ctfassets.net\/9od8q1jf23e1\/Le1Nk1L9nLJ2acxRSKkF6\/3046b37c0dacce7867f46b7834f1ea2b\/Mariya.jpg","authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","authorExternalUrl":"https:\/\/www.linkedin.com\/in\/mariyanurislamova\/","numberOfSessionsAndTotalTime":"14 - 24:24","sessions":[{"title":"Optimizing CAC","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/DXS2noNUUr5xuHwzIqxTL\/bf744010960d09fcb67af678843e1768\/Screenshot_2025-05-07_at_8.13.17_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082396875","timeSpan":"2:09"},{"title":"The Strategy","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/7mz9gsepNj3uvchWifUJLB\/efff07eee420b2ca44fd17246cf993ba\/Screenshot_2025-05-07_at_8.16.44_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082396990","timeSpan":"2:51"},{"title":"Getting Ads to Market at High Speed","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/4EcKhTOtzHxWaqeK40JcpH\/cfd92eb00685b147f4b6a4ea5f2ca2bf\/Screenshot_2025-05-07_at_8.18.25_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397157","timeSpan":"2:53"},{"title":"AI in Action","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/7fGigoMYg8JVhbYEQjlEnK\/3198dcd9ccb271bd1ee2d021b7870325\/Screenshot_2025-05-07_at_8.20.40_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397322","timeSpan":"2:50"},{"title":"Metrics","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/4kLYC5kEaBVzc1vKAmiA60\/16dbfa827ff19887e5db8f3603926250\/Screenshot_2025-05-07_at_8.22.33_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397486","timeSpan":"1:29"},{"title":"Key Takeaways","thumbnail":"\/\/images.ctfassets.net\/9od8q1jf23e1\/74QGL3x6Ukz1iLKXqbrTNm\/314fb8324d5b499002f463d655c948b4\/Screenshot_2025-05-07_at_8.24.01_PM.png","url":"https:\/\/player.vimeo.com\/video\/1082397564","timeSpan":"0:54"}]}

if (empty($fields)) {
    wp_redirect('/');
    return;
}
get_header();
?>
    <div class="gwc masterclass-details min-h-[90vh]">
        <div class="bg-grey-200 font-sailec">
            <div class="mx-auto min-h-[calc(100vh-195px)] max-w-screen-xl px-4 py-28 md:py-10">
                <div class="mx-[-15px] mb-9 flex flex-wrap">
                    <div class="mb-9 px-4 lg:max-w-[70%] lg:basis-[70%] ">
                        <div class="relative mb-3 pt-[56.25%]">
                            <iframe id="session-video" class="absolute left-0 top-0 h-full w-full rounded" height="100%"
                                    src="<?=$fields['sessions'][0]['url']?>" title="masterclass" width="100%"
                                    allowfullscreen></iframe>
                        </div>
                        <div class="hidden w-full rounded bg-white p-7 lg:block"><span id="session-title" class="text-md font-semibold"><?=$fields['sessions'][0]['title']?></span>
                        </div>
                        <div class="mt-9">
                            <div class="my-4"><?php foreach ($fields['categories'] as $category) { ?>
                                <span class="text-grey-500 bg-grey-300 mb-2 mr-1.5 inline-block rounded-sm p-1.5 text-xs leading-[20px]"><?=$category?></span>
                            <?php } ?></div>
                            <h2 class="text-3xl"><?=$fields['title']?></h2>
                            <p class="py-6 text-lg"><?=$fields['mainDescription']?></p>
                        </div>
                        <div class="border-grey-300 flex flex-wrap items-center justify-between border-y p-5">
                            <div class="flex items-center">
                                <figure class="relative mr-3 h-10 w-10"><img alt="<?=$fields['authorNames']?>" loading="lazy"
                                                                             decoding="async" data-nimg="fill"
                                                                             class="rounded-full object-cover"
                                                                             style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent"
                                                                             src="<?=$fields['authorImage']?>"/>
                                </figure>
                                <span class="text-md">Taught by<!-- --> <a
                                            class="text-lake-300 hover:text-lake-300 hover:underline"
                                            href="<?=$fields['authorExternalUrl']?>"
                                            rel="noopener noreferrer" target="_blank"><?=$fields['authorNames']?></a>
                                    <!-- -->· <span class="text-grey-400"><?=$fields['authorDesignations']?></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4 lg:max-w-[30%] lg:basis-[30%]">
                        <div class="mb-9 w-full rounded bg-white">
                            <div class="flex items-center gap-2 border-b px-5 py-6">
                                <div class="self-baseline">
                                    <svg fill="none" height="20" viewBox="0 0 20 20" width="20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.15827 3.72907L15.5396 3.65677C16.1151 3.65677 16.5468 4.09056 16.5468 4.66895V4.74125H17.6259H17.6978V4.66895C17.6978 3.43988 16.7626 2.5 15.5396 2.5L2.15827 2.5723C0.935252 2.5723 0 3.51218 0 4.74125V13.417C0 14.6461 0.935252 15.586 2.08633 15.586V14.4292C1.51079 14.4292 1.07914 13.9954 1.07914 13.417V4.74125C1.15108 4.16286 1.58273 3.72907 2.15827 3.72907Z"
                                              fill="#828282"></path>
                                        <path d="M11.7985 7.84964C11.6547 7.84964 11.5827 7.77734 11.4388 7.77734C10.0719 7.77734 8.92084 8.93412 8.92084 10.3078C8.92084 10.3801 8.92084 10.5247 8.92084 10.597C8.99278 10.8862 9.06472 11.1754 9.13666 11.4646C9.56832 12.3321 10.3597 12.9105 11.3669 12.9105C11.7266 12.9105 12.0863 12.8382 12.446 12.6936C13.3093 12.2598 13.8849 11.3923 13.8849 10.3801C13.8849 9.15101 12.9496 8.06654 11.7985 7.84964Z"
                                              fill="#828282"></path>
                                        <path d="M17.9137 5.32031H16.7626H4.8921C3.66908 5.32031 2.73383 6.26019 2.73383 7.48926V14.936V16.0928V16.1651C2.73383 17.3941 3.66908 18.334 4.8921 18.334H17.8417C19.0648 18.334 20 17.3941 20 16.1651V7.48926C20 6.26019 19.1367 5.32031 17.9137 5.32031ZM18.9209 16.1651C18.9209 16.7434 18.4892 17.1772 17.9137 17.1772H16.0432C15.8993 16.7434 15.7554 16.382 15.5396 16.0928C15.2518 15.659 14.964 15.2975 14.6043 14.936C14.3166 14.6468 14.0288 14.4299 13.6691 14.2853C13.0216 13.9238 12.3022 13.7069 11.5108 13.7069C9.85613 13.7069 8.34534 14.6468 7.48203 16.0928C7.2662 16.4543 7.12231 16.8157 6.97843 17.1772H4.8921C4.31656 17.1772 3.8849 16.7434 3.8849 16.1651V16.0928V14.936V7.48926C3.8849 6.83858 4.31656 6.40479 4.8921 6.40479H7.41008H11.0791H16.7626H17.8417C17.8417 6.40479 17.8417 6.40479 17.9137 6.40479C18.4892 6.40479 18.9209 6.83858 18.9209 7.41696V16.1651Z"
                                              fill="#828282"></path>
                                    </svg>
                                </div>
                                <span class="text-lg">Sessions</span><span
                                        class="text-sm text-gray-500"> (<?=$fields['numberOfSessionsAndTotalTime']?>)</span></div>
                            <div class="scrollbar-thin scrollbar-thumb-grey-300 scrollbar-track-grey-100 relative  max-h-[400px] overflow-auto">
                                <?php foreach ($fields['sessions'] as $session) { ?>
                                <button class="hover:bg-grey-100 flex w-full p-3 text-left transition-all"
                                        type="button" data-url="<?=$session['url']?>" data-title="<?=$session['title']?>" onClick="handleClick(this)">
                                    <figure class="mr-4"><img alt="<?=$session['title']?>" loading="lazy" width="120"
                                                              height="68" decoding="async" data-nimg="1"
                                                              style="color:transparent"
                                                              src="<?=$session['thumbnail']?>"/>
                                    </figure>
                                    <div class="grow basis-1/3">
                                        <div class="text-sm font-medium"><?=$session['title']?></div>
                                        <div class="text-xs text-gray-500"><?=$session['timeSpan']?></div>
                                    </div>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      function handleClick(element) {
        const url = element.dataset.url;
        const title = element.dataset.title;

        console.log(`url: ${url}, title: ${title}`);
        document.querySelector('#session-video').setAttribute('src', url);
        document.querySelector('#session-title').innerHTML = title;
      }
    </script>
<?php get_footer(); ?>