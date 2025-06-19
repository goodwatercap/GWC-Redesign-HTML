<?php
if( array_key_exists('fields', $args )){
    $fields = $args['fields'];
}

// [{"slug":"scaling-spend-and-optimizing-roi-through-an-ai-driven-creative-team","releaseDateTime":"2025-05-08T00:00","title":"Scaling Spend and Optimizing ROI Through an AI-Driven Creative Team","previewDescription":"Learn from Scentbird's incredible success how to increase monthly creatives, optimize CAC and utilize AI to cut costs and speed up production.","featuredImage":"\/\/images.ctfassets.net\/9od8q1jf23e1\/Le1Nk1L9nLJ2acxRSKkF6\/3046b37c0dacce7867f46b7834f1ea2b\/Mariya.jpg","authorNames":"Mariya Nurislamova","authorDesignations":"CEO & Co-Founder, Scentbird","categories":["AI","Marketing","Growth"]}]"
?>
<article class="masterclass">
    <a class="post" href="/masterclass/?article=<?php echo $fields['slug'] ?>">
        <div class="post-image"><img src="https:<?php echo $fields['featuredImage'] ?>"/></div>
            <div class="post-text">
                <?php $datetime = strtotime($fields['releaseDateTime']) ?>
                <div class="info">
                    <p><?php echo date("M j, Y", $datetime)?></p>
                    <div class="post-tags">
                        <?php foreach ($fields['categories'] as $categoryName) { ?>
                            <div class="l-tag <?php echo $categoryName ?>">
                                <?php echo $categoryName ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <h3><?php echo $fields['title'];?></h3>
                <p>by <?php echo $fields['authorNames']. ', ' . $fields['authorDesignations'] ?></p>
            </div>

    </a>
</article>
