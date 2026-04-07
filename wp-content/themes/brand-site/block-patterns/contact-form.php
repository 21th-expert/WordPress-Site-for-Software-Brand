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
      <form class="contact-form" method="post">
        <div class="form-row">
          <div class="form-group">
            <label for="fname">First Name *</label>
            <input type="text" id="fname" name="fname" required>
          </div>
          <div class="form-group">
            <label for="lname">Last Name *</label>
            <input type="text" id="lname" name="lname" required>
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="company">Company</label>
          <input type="text" id="company" name="company">
        </div>
        <div class="form-group">
          <label for="interest">I'm interested in</label>
          <select id="interest" name="interest">
            <option value="">Select an option</option>
            <option value="demo">Requesting a demo</option>
            <option value="pricing">Pricing information</option>
            <option value="support">Technical support</option>
            <option value="partnership">Partnership inquiry</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="message">Message *</label>
          <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit">Send message</button>
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