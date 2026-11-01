<?php
/**
 * Fallback contact form: validates and opens the visitor's email app (main.js).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form class="form" data-mail-form novalidate>
	<p class="form__intro"><?php esc_html_e( 'Fill in the form and your email app will open with the message ready to send.', 'quesada-fitness' ); ?></p>
	<div class="field">
		<label for="qf-name"><?php esc_html_e( 'Name', 'quesada-fitness' ); ?></label>
		<input class="input" id="qf-name" name="name" type="text" autocomplete="name" required>
		<p class="field__error" id="qf-name-error"></p>
	</div>
	<div class="field">
		<label for="qf-email"><?php esc_html_e( 'Email', 'quesada-fitness' ); ?></label>
		<input class="input" id="qf-email" name="email" type="email" autocomplete="email" required>
		<p class="field__error" id="qf-email-error"></p>
	</div>
	<div class="field">
		<label for="qf-message"><?php esc_html_e( 'Message', 'quesada-fitness' ); ?></label>
		<textarea class="input" id="qf-message" name="message" rows="5" required></textarea>
		<p class="field__error" id="qf-message-error"></p>
	</div>
	<button type="submit" class="btn btn--primary btn--block btn--lg"><?php esc_html_e( 'Write email', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
	<p class="form__status" role="status" hidden></p>
</form>
