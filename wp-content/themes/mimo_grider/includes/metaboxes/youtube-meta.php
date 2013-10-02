
<div class="my_meta_control">
 
    <p><a href="#" class="dodelete-youtubes button">Remove All</a></p>
 
    <?php while($mb->have_fields_and_multi('youtubes')): ?>
    <?php $mb->the_group_open(); ?>
 
        <a href="#" class="dodelete button">Remove</a>
 
        <?php $mb->the_field('youtubeids'); ?>
        
        
        <p><input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
 
    <?php $mb->the_group_close(); ?>
    <?php endwhile; ?>
 
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-youtubes button">Add</a></p>
 
</div>