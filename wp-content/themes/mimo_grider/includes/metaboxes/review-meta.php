<?php global $wpalchemy_media_access; ?>
<div class="my_meta_control">
 
    <p><a href="#" class="dodelete-reviews button">Remove All</a></p>
 
    <?php while($mb->have_fields_and_multi('reviews')): ?>
    <?php $mb->the_group_open(); ?>
 
        <a href="#" class="dodelete button">Remove</a>
 
        <?php $mb->the_field('ids'); ?>
        
        
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/> </p>
        <?php $mb->the_field('s_field'); ?>
		<select name="<?php $mb->the_name(); ?>">
			<option value="">Select...</option>
			<option value="1"<?php $mb->the_select_state('1'); ?>>1</option>
			<option value="2"<?php $mb->the_select_state('2'); ?>>2</option>
			<option value="3"<?php $mb->the_select_state('3'); ?>>3</option>
            <option value="4"<?php $mb->the_select_state('4'); ?>>4</option>
			<option value="5"<?php $mb->the_select_state('5'); ?>>5</option>
		</select>
 
        
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
    
 
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-reviews button">Add</a></p>
    
     <?php $mb->the_field('note'); ?>
        
        <label>Your Text final Rating</label><br/>
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
        <?php $mb->the_field('summary'); ?>
        
        <label>Review summary</label><br/>
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
 
</div>