<!--Update page contents-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<main role="main" class="flex-shrink-0">
    <div class="container">
        <h1>Update User</h1>
        <?php echo validation_errors(); ?>

        <?php echo form_open('users/update/' . $user->id); ?>
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $user->first_name; ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $user->last_name; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $user->email; ?>">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo $user->phone_number; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        <?php echo form_close(); ?>
    </div>
</main>

