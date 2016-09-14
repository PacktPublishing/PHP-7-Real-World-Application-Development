/**
 * Created by altafhussain on 10/14/15.
 */
var IWD = IWD;
$j(document).ready(function () {
    $j("#narrow-by-list dt.filter-title a").click(function () {
        var self = $j(this);
        var cssId = self.attr('id').split('-')[1];
        var child = $j('#narrow-by-list dd#filter-options-'+cssId+' ol');

        //alert('#narrow-by-list #filter-options-'+id);
        if(self.attr('class') == 'open')
        {
            self.removeClass('open');
            self.addClass('close');
            child.hide(300);
        }
        else if(self.attr('class') == 'close')
        {
            self.removeClass('close');
            self.addClass('open');
            child.show(300);
        }

    });

    /*opc checkout custom tabs and forms validations*/
    $j('#address-btn').click(function() {
        var addressForm = $('opc-address-form-billing');
        var validator = new Validation(addressForm);
        if(validator.validate()) {
            $j('#opc-step-1-content').hide('fade');
            $j('#opc-step-3-content').show('fade');
            $j('h3#opc-step-1').removeClass('active');
            $j('h3#opc-step-3').addClass('active');
            $j('h3#opc-step-1 a').show();
            $j('h3#opc-step-2 a').hide();
        }
        return false;
    });

    $j('#shipping-btn').click(function() {
        $j('#opc-step-2-content').hide('fade');
        $j('#opc-step-3-content').show('fade');
        $j('h3#opc-step-2').removeClass('active');
        $j('h3#opc-step-3').addClass('active');
        $j('h3#opc-step-2 a').show();
    });

    $j('a.edit-add-btn').click(function() {
        $j('#opc-step-1-content').show('fade');
        $j('#opc-step-2-content').hide('fade');
        $j('#opc-step-3-content').hide('fade');
        $j('h3#opc-step-1').addClass('active');
        $j('h3#opc-step-2').removeClass('active');
        $j('h3#opc-step-3').removeClass('active');

        $j('h3#opc-step-1 a').hide();
        $j('h3#opc-step-2 a').hide();
    });

    $j('a.edit-ship-btn').click(function() {
        $j('#opc-step-1-content').hide('fade');
        $j('#opc-step-2-content').show('fade');
        $j('#opc-step-3-content').hide('fade');
        $j('h3#opc-step-2').addClass('active');
        $j('h3#opc-step-1').removeClass('active');
        $j('h3#opc-step-3').removeClass('active');
        $j('h3#opc-step-2 a').hide();
    });
});


/**
 * Created by altafhussain on 10/14/15.
 */
var IWD = IWD;
$j(document).ready(function () {
    $j("#narrow-by-list dt.filter-title a").click(function () {
        var self = $j(this);
        var cssId = self.attr('id').split('-')[1];
        var child = $j('#narrow-by-list dd#filter-options-'+cssId+' ol');

        //alert('#narrow-by-list #filter-options-'+id);
        if(self.attr('class') == 'open')
        {
            self.removeClass('open');
            self.addClass('close');
            child.hide(300);
        }
        else if(self.attr('class') == 'close')
        {
            self.removeClass('close');
            self.addClass('open');
            child.show(300);
        }

    });

    /*opc checkout custom tabs and forms validations*/
    $j('#address-btn').click(function() {
        var addressForm = $('opc-address-form-billing');
        var validator = new Validation(addressForm);
        if(validator.validate()) {
            $j('#opc-step-1-content').hide('fade');
            $j('#opc-step-3-content').show('fade');
            $j('h3#opc-step-1').removeClass('active');
            $j('h3#opc-step-3').addClass('active');
            $j('h3#opc-step-1 a').show();
            $j('h3#opc-step-2 a').hide();
        }
        return false;
    });

    $j('#shipping-btn').click(function() {
        $j('#opc-step-2-content').hide('fade');
        $j('#opc-step-3-content').show('fade');
        $j('h3#opc-step-2').removeClass('active');
        $j('h3#opc-step-3').addClass('active');
        $j('h3#opc-step-2 a').show();
    });

    $j('a.edit-add-btn').click(function() {
        $j('#opc-step-1-content').show('fade');
        $j('#opc-step-2-content').hide('fade');
        $j('#opc-step-3-content').hide('fade');
        $j('h3#opc-step-1').addClass('active');
        $j('h3#opc-step-2').removeClass('active');
        $j('h3#opc-step-3').removeClass('active');

        $j('h3#opc-step-1 a').hide();
        $j('h3#opc-step-2 a').hide();
    });

    $j('a.edit-ship-btn').click(function() {
        $j('#opc-step-1-content').hide('fade');
        $j('#opc-step-2-content').show('fade');
        $j('#opc-step-3-content').hide('fade');
        $j('h3#opc-step-2').addClass('active');
        $j('h3#opc-step-1').removeClass('active');
        $j('h3#opc-step-3').removeClass('active');
        $j('h3#opc-step-2 a').hide();
    });
});

