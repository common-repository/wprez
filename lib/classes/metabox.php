<?php global $wpalchemy_media_access; ?>

<div class="steps-edit">
     
    <a style="float:right; margin:0 10px; background: red; color:white;" href="#" class="dodelete-steps button warning">Remove All</a>
    <h4 class="update-warning"><?php _e('NOTICE:  You must update the wprez to save the new order', 'wprex' ); ?></h4> 
   
    <p>Add steps to the WPrez by entering the content and setting the position attributes below.</p>
    <?php while($mb->have_fields_and_multi('steps')):  ?>

        <?php $mb->the_group_open(); ?>

        <div class="postbox sortable">
            <h3 class="hndle"><?php _e('Step Number: ', 'wprez'); echo $mb->the_index(); ?></h3>
            <div class="inside">
             
                <?php $mb->the_field('steptitle'); ?>
                <label><?php _e('Slide Title', 'wprez' ); ?></label>
                <p><input type="text" class="title" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                <span class="note"><?php _e('The title is only displayed here in the editing screen, not in the presentation itself', 'wprez'); ?></span>
                <?php  global $page_type_richtext; 
                $mb->the_field('stepcontent'); ?>
                <div class="customEditor">
                    <textarea rows="10" cols="50" name="<?php $mb->the_name(); ?>" id="<?php $mb->the_name(); ?>"><?php echo wpautop( $mb->get_the_value() ); ?></textarea>
                </div>
             
                <?php $mb->the_field('image'); ?>
                <?php $wpalchemy_media_access->setGroupName('image-n' . $mb->get_the_index())->setInsertButtonLabel('Insert Image'); ?>
             
               <!--  <p><?php _e('Upload image file or insert url to existing image' , 'wprez'); ?>
                <?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
                <?php echo $wpalchemy_media_access->getButton(); ?> -->

                <ul class="inline third">

                    <li>
                        <?php $mb->the_field('stepid'); ?>
                            <label>Custom ID to use</label>
                            <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                            <span class="note"><?php _e('Enter the custom ID to use. This will allow you to link to specific places in the wprez using a hash in the url.', 'wprez');
                            _e('Some presets are available such as: title, big, tiny, ing, imagination, source, its-in-3d and overview.', 'wprez'); ?></span>
                    </li>

                    <li>
                       <?php $mb->the_field('type'); ?>
                            <label>Type of step</label>
                            <p><input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                            <span class="note">step and slide are available</span> 
                    </li>
                    
                    <li>
                        <?php $mb->the_field('scale'); ?>
                        <label>Scale of this step</label>
                        <p><input type="number" min="1" max="9" step="1" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                        <span class="note">scale the steps using intergers 1-9 for best results</span>
                    </li>
                </ul>

                <ul class="inline third" style="clear: both;">
                    <li>
                        <?php $mb->the_field('xpos'); ?>
                        <label>X position of this step</label>
                        <p><input class="copyable" type="number" min="-10000" max="10000" step="500" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                    </li>
                    
                    <li>
                        <?php $mb->the_field('ypos'); ?>
                        <label>Y position of this step</label>
                        <p><input class="copyable" type="number" min="-10000" max="10000" step="500" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                    </li>
                    
                    <li>
                        <?php $mb->the_field('zpos'); ?>
                        <label>Z position of this step</label>
                        <p><input class="copyable" type="number" min="-10000" max="10000" step="500" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                    </li>

                </ul>

                <ul class="inline third">
                    <li>
                        <?php $mb->the_field('rotate'); ?>
                        <label>Rotation of this step</label>
                        <p><input type="number" min="-3600" max="3600" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                    </li>
                    
                    <li>
                        <?php $mb->the_field('xrotate'); ?>
                        <label>X rotation of the step</label>
                        <p><input type="number" min="-3600" max="3600" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                    </li>
                    
                    <li>
                        <?php $mb->the_field('yrotate'); ?>
                        <label>Y rotation of this step</label>
                        <p><input type="number" min="-3600" max="3600" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/></p>
                    </li>

                </ul>

                </p>
                <a href="#" class="dodelete button">Remove This Step</a>

            </div>
        </div>
        <?php $mb->the_group_close(); ?>
    
    <?php endwhile; ?>
     
    <p style="margin-bottom:15px; padding-top:5px;"><a href="#" class="docopy-steps button">Add New Step</a></p>

</div>
