<?php
/**
 * Tastefully simple recipe template.
 *
 * @link       http://bootstrapped.ventures
 * @since      1.0.0
 * @modifiedby       Anna Rider
 * @date       20171019
 *
 * @package    WP_Recipe_Maker
 * @subpackage WP_Recipe_Maker/templates/recipe/tastfully-simple
 */

// @codingStandardsIgnoreStart
?>
<div class="wprm-recipe wprm-recipe-tastefully-simple" itemscope itemtype="http://schema.org/Recipe">
	<meta itemprop="author" content="<?php echo $recipe->author_meta(); ?>" />
	<meta itemprop="datePublished" content="<?php echo $recipe->date(); ?>" />
	<meta itemprop="image" content="<?php echo $recipe->image_url( 'vertical-thumbnail' ); ?>" />
	<!-- Beginning section -->
	<div class="wprm-recipe-name wprm-color-header" itemprop="name"><?php echo $recipe->name(); ?>
		<p>Using the new templates!!!</p>
	</div>
	<div class="wprm-recipe-image-container">
		<!-- Full Main Image -->
		<div class="wprm-recipe-image"><?php echo WPRM_Template_Helper::recipe_image( $recipe, 'vertical-thumbnail' ); ?></div>
	</div>
	<!-- Recipe summary -->
	<div class="wprm-recipe-summary" itemprop="description">
		<?php echo $recipe->summary(); ?>
	</div>
	<!-- Details -->
	<div class="wprm-recipe-details-container">
		<?php
		$taxonomies = WPRM_Taxonomies::get_taxonomies();

		foreach ( $taxonomies as $taxonomy => $options ) :
			$key = substr( $taxonomy, 5 );
			$terms = $recipe->tags( $key );

			if ( count( $terms ) > 0 ) : ?>
			<div class="wprm-recipe-<?php echo $key; ?>-container">
				<span class="wprm-recipe-details-name wprm-recipe-<?php echo $key; ?>-name"><?php echo WPRM_Template_Helper::label( $key . '_tags', $options['singular_name'] ); ?>:</span>
				<span class="wprm-recipe-<?php echo $key; ?>"<?php echo WPRM_Template_Helper::tags_meta( $key ); ?>>
					<?php foreach ( $terms as $index => $term ) {
						if ( 0 !== $index ) {
							echo ', ';
						}
						echo $term->name;
					} ?>
				</span>
			</div>
		<?php endif; // Count.
		endforeach; // Taxonomies. ?>
		<?php if ( $recipe->servings() ) : ?>

		<?php if ( $recipe->calories() ) : ?>
		<div class="wprm-recipe-calories-container" itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation">
			<span class="wprm-recipe-details-name wprm-recipe-calories-name"><?php echo WPRM_Template_Helper::label( 'calories' ); ?></span>: <span itemprop="calories"><span class="wprm-recipe-details wprm-recipe-calories"><?php echo $recipe->calories(); ?></span> <span class="wprm-recipe-details-unit wprm-recipe-calories-unit"><?php _e( 'kcal', 'wp-recipe-maker' ); ?></span></span>
		</div>
		<?php endif; // Calories. ?>
		<?php if ( $recipe->author() ) : ?>
		<div class="wprm-recipe-author-container">
			<span class="wprm-recipe-details-name wprm-recipe-author-name"><?php echo WPRM_Template_Helper::label( 'author' ); ?></span>: <span class="wprm-recipe-details wprm-recipe-author"><?php echo $recipe->author(); ?></span>
		</div>
		<?php endif; // Author. ?>
	</div>


	<!-- Recipe times -->
	<?php if ( $recipe->prep_time() || $recipe->prep_time() || $recipe->prep_time() ) : ?>
	<div class="wprm-recipe-times-container wprm-color-border">
		<?php if ( $recipe->prep_time() ) : ?>
		<div class="wprm-recipe-time-container wprm-color-border">
			<meta itemprop="prepTime" content="PT<?php echo $recipe->prep_time(); ?>M" />
			<div class="wprm-recipe-time-header"><?php echo WPRM_Template_Helper::label( 'prep_time' ); ?></div>
			<div class="wprm-recipe-time"><?php echo $recipe->prep_time_formatted( true ); ?></div>
		</div>
		<?php endif; // Prep time. ?>
		<?php if ( $recipe->cook_time() ) : ?>
			<div class="wprm-recipe-time-container wprm-color-border">
				<meta itemprop="cookTime" content="PT<?php echo $recipe->cook_time(); ?>M" />
				<div class="wprm-recipe-time-header"><?php echo WPRM_Template_Helper::label( 'cook_time' ); ?></div>
				<div class="wprm-recipe-time"><?php echo $recipe->cook_time_formatted( true ); ?></div>
			</div>
		<?php endif; // Cook time. ?>
		<?php if ( $recipe->total_time() ) : ?>
			<div class="wprm-recipe-time-container wprm-color-border">
				<meta itemprop="totalTime" content="PT<?php echo $recipe->total_time(); ?>M" />
				<div class="wprm-recipe-time-header"><?php echo WPRM_Template_Helper::label( 'total_time' ); ?></div>
				<div class="wprm-recipe-time"><?php echo $recipe->total_time_formatted( true ); ?></div>
			</div>
		<?php endif; // Total time. ?>
		<div class="wprm-clear-left">&nbsp;</div>
	</div>
	<?php endif; // Recipe times. ?>
	<!-- 5 Star Rating -->
	<div class="wprm-recipe-buttons">
		<?php echo $recipe->rating_stars( true ); ?>
	</div>

	<!-- Ingredients Section -->
	<?php
	$ingredients = $recipe->ingredients();
	if ( count( $ingredients ) > 0 ) : ?>
	<div class="wprm-recipe-ingredients-container">
		
		<div class="wprm-recipe-header wprm-color-header"><?php echo WPRM_Template_Helper::label( 'ingredients' ); ?></div>
		<div class="wprm-recipe-servings-container">
			<span class="wprm-recipe-details-name wprm-recipe-servings-name"><?php echo WPRM_Template_Helper::label( 'servings' ); ?></span>: <span itemprop="recipeYield"><span class="wprm-recipe-details wprm-recipe-servings"><?php echo $recipe->servings(); ?></span> <span class="wprm-recipe-details-unit wprm-recipe-servings-unit"><?php echo $recipe->servings_unit(); ?></span></span>
		</div>
		<?php endif; // Servings. ?>
		<?php foreach ( $ingredients as $ingredient_group ) : ?>
		<div class="wprm-recipe-ingredient-group">
			<?php if ( $ingredient_group['name'] ) : ?>
			<div class="wprm-recipe-group-name wprm-recipe-ingredient-group-name"><?php echo $ingredient_group['name']; ?></div>
			<?php endif; // Ingredient group name. ?>
			<ul class="wprm-recipe-ingredients">
				<?php foreach ( $ingredient_group['ingredients'] as $ingredient ) : ?>
				<li class="wprm-recipe-ingredient" itemprop="recipeIngredient">
					<?php if ( $ingredient['amount'] ) : ?>
					<span class="wprm-recipe-ingredient-amount"><?php echo $ingredient['amount']; ?></span>
					<?php endif; // Ingredient amount. ?>
					<?php if ( $ingredient['unit'] ) : ?>
					<span class="wprm-recipe-ingredient-unit"><?php echo $ingredient['unit']; ?></span>
					<?php endif; // Ingredient unit. ?>
					<span class="wprm-recipe-ingredient-name"><?php echo WPRM_Template_Helper::ingredient_name( $ingredient, true ); ?></span>
					<?php if ( $ingredient['notes'] ) : ?>
					<span class="wprm-recipe-ingredient-notes"><?php echo $ingredient['notes']; ?></span>
					<?php endif; // Ingredient notes. ?>
				</li>
				<?php endforeach; // Ingredients. ?>
			</ul>
		</div>
	 <?php endforeach; // Ingredient groups. ?>
	 <?php echo WPRM_Template_Helper::unit_conversion( $recipe ); ?>
	</div>
	<?php endif; // Ingredients. ?>

	<!-- Instructions -->
	<?php
	$instructions = $recipe->instructions();
	if ( count( $instructions ) > 0 ) : ?>
	<div class="wprm-recipe-instructions-container">
		<div class="wprm-recipe-header wprm-color-header"><?php echo WPRM_Template_Helper::label( 'instructions' ); ?></div>
		<?php foreach ( $instructions as $instruction_group ) : ?>
		<div class="wprm-recipe-instruction-group">
			<?php if ( $instruction_group['name'] ) : ?>
			<div class="wprm-recipe-group-name wprm-recipe-instruction-group-name"><?php echo $instruction_group['name']; ?></div>
			<?php endif; // Instruction group name. ?>
			<ol class="wprm-recipe-instructions">
				<?php foreach ( $instruction_group['instructions'] as $instruction ) : ?>
				<li class="wprm-recipe-instruction">
					<?php if ( $instruction['text'] ) : ?>
					<div class="wprm-recipe-instruction-text" itemprop="recipeInstructions"><?php echo $instruction['text']; ?></div>
					<?php endif; // Instruction text. ?>
					<?php if ( $instruction['image'] ) : ?>
					<div class="wprm-recipe-instruction-image"><?php echo WPRM_Template_Helper::instruction_image( $instruction, 'vertical-thumbnail-small' ); ?></div>
					<?php endif; // Instruction image. ?>
				</li>
				<?php endforeach; // Instructions. ?>
			</ol>
		</div>
		<?php endforeach; // Instruction groups. ?>
	</div>
	<?php endif; // Instructions. ?>


	<!-- Notes -->
	<?php if ( $recipe->notes() ) : ?>
	<div class="wprm-recipe-notes-container">
		<div class="wprm-recipe-header wprm-color-header"><?php echo WPRM_Template_Helper::label( 'notes' ); ?></div>
		<?php echo $recipe->notes(); ?>
	</div>
	<?php endif; // Notes ?>

	<!-- Nutrition -->
	<?php if ( $recipe->nutrition() ) : ?>
	<div class="wprm-recipe-nutrition-container">
		<div class="wprm-recipe-header wprm-color-header"><?php echo WPRM_Template_Helper::label( 'nutrition' ); ?></div>
		<?php echo WPRM_Template_Helper::nutrition_label( $recipe->id() ); ?>
	<?php endif; // Nutrition ?>

	<!-- Print button -->
	<div class="wprm-recipe-buttons">
		<span class="wprm-recipe-print wprm-color-accent"><?php echo WPRM_Template_Helper::label( 'print_button' ); ?></span>
	</div>	
</div>
