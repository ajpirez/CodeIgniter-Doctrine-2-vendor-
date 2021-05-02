<form method="Post" action="<?php echo base_url('reservation/update') ?>" class="form-group">
    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $getContact->id ?>">
    <input type="text" minlength="3" pattern="[A-Za-z ]{3,200}" class="form-control col-md-2" id="name" required name="name" placeholder="Contact Name"
           value="<?php echo $getContact->nombre ?>">
    <select class="form-control col-md-4" id="contact_type" name="contact_type" required>
        <?php foreach ($selContactType as $value) { ?>
            <option <?php echo $getContact->type_id === $value->id ? 'selected' : ''; ?>
                    value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
        <?php } ?>
    </select>
    <input type="tel" minlength="4" maxlength="10" pattern="^[0-9]*" class="form-control col-md-2" id="phone" name="phone" placeholder="Phone"
           value="<?php echo $getContact->phone ?>">
    <input type="date" class="form-control col-md-4" id="date" name="dob" placeholder="Birth Date" required
           value="<?php echo $getContact->dob ?>">

    <div class="input-group mb-3 style">
        <textarea class="form-control" id="description" rows="10"
                  name="description"><?php echo $getContact->description ?></textarea>
    </div>
    </div>
    </div>
    <div class="input-group mt-4 col-md-12 offset-md-9 style">
        <button type="submit" class="btn-danger">Send</button>
    </div>
</form>
<?php
