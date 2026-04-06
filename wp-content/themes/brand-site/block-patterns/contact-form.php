<?php
/**
 * Title: Contact Form Section
 * Slug: brand-site/contact-form
 * Categories: brand-site
 * Description: A simple contact form section with fields for name, email, and message.
 */

?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"64px","bottom":"64px"}}}} -->
<div class="wp-block-group alignwide" style="padding-top:64px;padding-bottom:64px">
  <!-- wp:heading {"level":2} -->
  <h2>Get in touch</h2>
  <!-- /wp:heading -->

  <!-- wp:paragraph -->
  <p>Have questions about our products or need help getting started? We'd love to hear from you.</p>
  <!-- /wp:paragraph -->

  <!-- wp:columns -->
  <div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:html -->
      <form action="#" method="post" class="contact-form">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="wp-block-button__link has-background-color has-secondary-background-color has-text-color has-background">Send message</button>
      </form>
      <!-- /wp:html -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:paragraph -->
      <p><strong>Address:</strong><br>123 Business St<br>City, State 12345</p>
      <!-- /wp:paragraph -->
      <!-- wp:paragraph -->
      <p><strong>Email:</strong><br>hello@brand-site.com</p>
      <!-- /wp:paragraph -->
      <!-- wp:paragraph -->
      <p><strong>Phone:</strong><br>(555) 123-4567</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div>
<!-- /wp:group -->