<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package creative-company
 */

if(!empty($_POST)){
    $message = "";
    $errors = array();
    if(empty($_POST['owner_name'])){
        $errors['owner_name'] = "Please enter owner name";
    }
    if(empty($_POST['store_name'])){
        $errors['store_name'] = "Please enter store name";
    }
    if(!is_email($_POST['store_email'])){
        $errors['store_email'] = "Please enter valid email";
    }
    if(!is_email($_POST['email'])){
        $errors['email'] = "Please enter valid email";
    }
    if(empty($_POST['phone'])){
        $errors['phone'] = "Please enter phone number";
    }
    if(empty($_POST['terms'])){
        $errors['terms'] = "Please check terms & conditions";
    }

    if(empty($errors)){//no error store data.
       global $wpdb;
       $data = array();
       $data['owner_name'] = $_POST['owner_name'] ;      
       $data['store_name'] = $_POST['store_name'];
       $data['store_email'] = $_POST['store_email'];
       $data['email'] = $_POST['email'];
       $data['phone'] = $_POST['phone'];

       $insert = $wpdb->insert('wp_vendor_reg_data', $data);
       if($insert){
            $message = "Your request submitted. We will contact you soon";
       }else{
            $message = "Your request could not be completed. Due to internal problem. Try again later";
       }
    }
    
}
?>
<div class="col-md-12 col-sm-12 col-xs-12 wow fadeIn" data-wow-duration="0.8s" data-wow-delay="0.4s">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="single-news">
                <?php if( has_post_thumbnail() ): ?>
                    <div class="news-head">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>
                <div class="news-body">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="title"><span class="user"><i class="fa fa-user" aria-hidden="true"></i><?php echo esc_html( get_the_author_meta() ); ?></span> <span class="comment"><i class="fa fa-comment-o"></i><?php comments_number( 'No Comment', 'One Comment', '% Comments' ); ?></span></div>
                    <?php the_content(); ?>

                    <?php if(!empty($message)){?>
                        <p class="label label-success success_header"><?php echo $message; unset($message);?></p>
                        <?php } ?>
                    <form action="<?php the_permalink(); ?>" method="POST" id="vendorReg">
                        <div class="form-group ">
                            <label for="owner_name">Owner Name *</label>
                            <input type="text" name="owner_name" class="form-control" value="<?php if(!empty( $_POST['owner_name'])){echo $_POST['owner_name']; }?>" aria-describedby="" placeholder="Enter owner name" ">
                            <?php if(!empty($errors['owner_name'])){ ?>
                            <small id="emailHelp" class="form-text text-muted error"><?php echo $errors['owner_name']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group ">
                            <label for="store_name">Store Name *</label>
                            <input type="text" name="store_name" class="form-control" value="<?php if(!empty( $_POST['store_name'])){echo $_POST['store_name']; }?>" aria-describedby="" placeholder="Enter store name" ">
                            <?php if(!empty($errors['store_name'])){ ?>
                            <small id="emailHelp" class="form-text text-muted error"><?php echo $errors['store_name']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group ">
                            <label for="store_email">Store Email *</label>
                            <input type="email" name="store_email" class="form-control" value="<?php if(!empty( $_POST['store_name'])){echo $_POST['store_name']; }?>" aria-describedby="" placeholder="Enter store email" ">
                            <?php if(!empty($errors['store_email'])){ ?>
                            <small id="emailHelp" class="form-text text-muted error"><?php echo $errors['store_email']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group ">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" value="<?php if(!empty( $_POST['email'])){echo $_POST['email']; }?>" aria-describedby="emailHelp" placeholder="Enter email" ">
                            <?php if(!empty($errors['email'])){ ?>
                            <small id="emailHelp" class="form-text text-muted error"><?php echo $errors['email']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone *</label>
                            <input type="text" name="phone" class="form-control" value="<?php if(!empty( $_POST['phone'])){echo $_POST['phone']; }?>" placeholder="Phone Number" ">
                            <?php if(!empty($errors['phone'])){ ?>
                            <small id="emailHelp" class="form-text text-muted error"><?php echo $errors['phone']; ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-check">
                            <input name="terms" id="terms" type="checkbox" class="form-check-input"  <?php if(!empty( $_POST['terms'])){echo 'checked'; } ?> value="1" ">
                            <label class="form-check-label" for="terms">Agree to terms & conditions.</label>
                            <?php if(!empty($errors['terms'])){ ?>
                            <small id="emailHelp" class="form-text text-muted error"><?php echo $errors['terms']; ?></small>
                            <?php } ?>
                        </div>
                        <button type="submit" name="submit" id="" class="btn btn-primary vendor-btn" >Submit</button>
                       
                    </form>
                </div>
        </div>
	</article>
</div>