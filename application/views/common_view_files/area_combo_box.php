<style>
    .select2 .selection .select2-selection--single,
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border-width: 0 0 1px 0 !important;
        border-radius: 0 !important;
        height: 2.05rem;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-width: 0 0 1px 0 !important;
        border-radius: 0 !important;
    }

    .select2-results__option {
        color: #1d1c1c;
        padding: 8px 16px;
        font-size: 16px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #eee !important;
        color: #1d1c1c !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #e1e1e1 !important;
    }

    .select2-dropdown {
        border: none !important;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .select2-container--default .select2-results__option[role=group] .select2-results__group {
        background-color: #333333;
        color: #fff;
    }

    .select2-container .select2-search--inline .select2-search__field {
        margin-top: 0 !important;
    }

    .select2-container .select2-search--inline .select2-search__field:focus {
        border-bottom: none !important;
        box-shadow: none !important;
    }

    .select2-container .select2-selection--multiple {
        min-height: 2.05rem !important;
    }

    .select2-container--default.select2-container--disabled .select2-selection--single {
        background-color: #ddd !important;
        color: rgba(0, 0, 0, 0.26);
        border-bottom: 1px dotted rgba(0, 0, 0, 0.26);
    }

    input[type=text],
    input[type=password],
    input[type=email],
    input[type=url],
    input[type=time],
    input[type=date],
    input[type=datetime-local],
    input[type=tel],
    input[type=number],
    input[type=search],
    textarea.materialize-textarea {

        &.valid+label::after,
        &.invalid+label::after,
        &:focus.valid+label::after,
        &:focus.invalid+label::after {
            white-space: pre;
        }

        &.empty {

            &:not(:focus).valid+label::after,
            &:not(:focus).invalid+label::after {
                top: 2.8rem;

            }
        }
    }
</style>
<label for="Area" class="active">Select Area</label>
<select id="Area" name="Area[]" class="" style="width:100%;display: none;" multiple>
    <?php
    if ($AreaID === 0 || $AreaID === '') {
    ?>
        <option disable>Select a Area</option>
    <?php
    }
    foreach ($all_data as $key => $value) {
        if (strpos($AreaName, $value->AreaName) !== false) {
            $sel = "selected=selected";
        } else {
            $sel = "";
        }
    ?>
        <option value='<?php echo $value->AreaName; ?>' <?php echo $sel; ?>> <?php echo $value->AreaName; ?></option>
    <?php
    }
    ?>
</select>
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/css/materialize.min.css" rel="stylesheet" /> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.4/js/materialize.min.js"></script> -->
<script>
    // $(document).ready(function() {
    //     $('#Area').select2();
    // });
</script>
<script>
    $('select').select2({
        width: "100%"
    });
</script>