<div class="overlay">
  <div class='modale'>
    <?php echo wp_get_attachment_image(159, "", array("class" => "img-responsive"));  ?>
    <form action="" method="post">
      <ul>
        <li>
          <label for="name">NOM</label>
          <input type="text" id="name" name="user_name" />
        </li>
        <li>
          <label for="mail">E-MAIL</label>
          <input type="email" id="mail" name="user_mail" />
        </li>
        <li>
          <label for="reference">REF.PHOTO</label>
          <input type="text" id="reference" name="ref" value="<?php echo get_field("reference"); ?>" />
        </li>
        <li>
          <label for="msg">MESSAGE</label>
          <textarea id="msg" name="user_message"></textarea>
        </li>
      </ul>
      <input type="submit" value="Envoyer" />
    </form>
  </div>
</div>