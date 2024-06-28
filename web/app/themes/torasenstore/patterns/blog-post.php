<?php
/**
 * Title: Blog Post
 * Slug: torasen/blog-post
 * Categories: posts
 * Description: Display the contents of a blog post.
 * Keywords: blog, article, post
 */
?>
<!-- wp:group {"tagName":"main","style":{"spacing":{"margin":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|xxl"},"blockGap":"var:preset|spacing|sm"}},"layout":{"type":"constrained","contentSize":"1350px"}} -->
<main class="wp-block-group" style="margin-top:var(--wp--preset--spacing--sm);margin-bottom:var(--wp--preset--spacing--xxl)"><!-- wp:paragraph {"fontSize":"xs","fontFamily":"inconsolata"} -->
<p class="has-inconsolata-font-family has-xs-font-size">[ Breadcrumbs ]</p>
<!-- /wp:paragraph -->

<!-- wp:query {"queryId":26,"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"layout":{"type":"constrained"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}}} -->
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|sm","bottom":"var:preset|spacing|sm"}},"border":{"top":{"color":"var:preset|color|mid-grey","width":"1px"},"right":[],"bottom":{"color":"var:preset|color|mid-grey","width":"1px"},"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--mid-grey);border-top-width:1px;border-bottom-color:var(--wp--preset--color--mid-grey);border-bottom-width:1px;padding-top:var(--wp--preset--spacing--sm);padding-bottom:var(--wp--preset--spacing--sm)"><!-- wp:post-date {"format":"d/m/Y","style":{"elements":{"link":{"color":{"text":"var:preset|color|dark-grey"}}}},"textColor":"dark-grey"} /-->

<!-- wp:paragraph -->
<p><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">Back to blog</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|lg","left":"var:preset|spacing|xxl"},"margin":{"top":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--lg)"><!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%"><!-- wp:post-title {"isLink":true} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"100%"} -->
<div class="wp-block-column" style="flex-basis:100%"><!-- wp:post-content /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></main>
<!-- /wp:group -->