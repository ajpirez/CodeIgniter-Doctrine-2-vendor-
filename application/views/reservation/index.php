<form method="Post" action="<?php echo base_url('reservation/insert') ?>" class="form-group">
    <input type="text" minlength="3" pattern="[A-Za-z ]{3,200}" class="form-control col-md-2" id="name" name="name" required placeholder="Contact Name">
    <select class="form-control col-md-4" id="contact_type" name="contact_type" required>
        <?php foreach ($selContactType as $value) { ?>
            <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
        <?php } ?>
    </select>
    <input type="tel" minlength="4" maxlength="10" pattern="^[0-9]*" class="form-control col-md-2" id="phone" name="phone" placeholder="Phone">
    <input type="date" class="form-control col-md-4" id="date" name="dob" required placeholder="Birth Date">


    <div class="input-group mb-3 style">
        <textarea class="form-control" id="description" rows="10" name="description"></textarea>
    </div>
    <div class="input-group mt-4 col-md-12 offset-md-9 style">
        <button type="submit" class="btn-danger">Send</button>
    </div>
</form>

<?php
