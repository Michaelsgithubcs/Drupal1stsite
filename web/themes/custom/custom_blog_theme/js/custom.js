/**
 * Custom Blog Theme JavaScript
 */
(function (Drupal) {
  'use strict';

  Drupal.behaviors.customBlogTheme = {
    attach: function (context, settings) {
      // Add smooth scroll to top functionality
      const blogPosts = context.querySelectorAll('.blog-post');
      
      blogPosts.forEach(function(post) {
        if (!post.classList.contains('js-processed')) {
          post.classList.add('js-processed');
          
          // Example: Add reading time estimate
          const content = post.querySelector('.blog-post__content');
          if (content) {
            const wordCount = content.innerText.split(/\s+/).length;
            const readingTime = Math.ceil(wordCount / 200); // Assuming 200 words per minute
            
            const meta = post.querySelector('.blog-post__meta');
            if (meta) {
              const readingTimeSpan = document.createElement('span');
              readingTimeSpan.className = 'blog-post__reading-time';
              readingTimeSpan.textContent = readingTime + ' min read';
              meta.appendChild(readingTimeSpan);
            }
          }
        }
      });
    }
  };

})(Drupal);
