<!--Create user page-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        <?php echo validation_errors(); ?>

        <?php echo form_open('users/create'); ?>
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter your phone number">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <?php echo form_close(); ?>
    </div>
</main>
