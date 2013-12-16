<div class="clearfix"></div>
<div class="row">
<article class="span12">

<!-- Wizard -->
<header>
        
</header>
<section id="wizard" class="wizard">
        <ul>
                <li>
                        <a href="#step-1">
                                <span class="stepDesc">Lifestyle/Interests Profile</span>
                        </a>
                </li>
                <li>
                        <a href="#step-2">
                                <span class="stepDesc">Package Pickup Settings</span>
                        </a>
                </li>
        </ul>

        <div id="step-1" style="width: 100%">
                <p>Fill out this personality profile so we can accurately match you with possible roommates that have similar life style habits, interests, and hobbies</p>
                <form>
                <fieldset>
                    <div class="control-group">
                        <label for="input" class="control-label">Major</label>
                        <div class="controls">
                                <input type="text" id="prof-major">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Academic Focus</label>
                        <div class="controls">
                                <input type="text" value="1" class="input-xlarge num-spinner-input" id="prof-academic-focus">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Neatness</label>
                        <div class="controls">
                                <input type="text" value="1" class="input-xlarge num-spinner-input" id="prof-neatness">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Visitors</label>
                        <div class="controls">
                                <input type="text" value="1" class="input-xlarge num-spinner-input" id="prof-visitors">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Active Level</label>
                        <div class="controls">
                                <input type="text" value="1" class="input-xlarge num-spinner-input" id="prof-active">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Tv</label>
                        <div class="controls">
                                <input type="text" value="1" class="input-xlarge num-spinner-input" id="prof-tv">
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Smoke</label>
                        <div class="controls">
                            <?php
                                $options = array(
                                    '' => 'Are you a smoker?',
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                );
                                $id = 'id="prof-smoker"';
                                echo form_dropdown('prof-smoker', $options, '', $id);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Live With A Smoker</label>
                        <div class="controls">
                            <?php
                                $options = array(
                                    '' => 'Live with a smoker?',
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                );
                                $id = 'id="prof-live-with-smoker"';
                                echo form_dropdown('prof-live-with-smoker', $options, '', $id);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Pet</label>
                        <div class="controls">
                            <?php
                                $options = array(
                                    '' => 'Do you have a pet?',
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                );
                                $id = 'id="prof-pet"';
                                echo form_dropdown('prof-pet', $options, '', $id);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Live with small furry animals?</label>
                        <div class="controls">
                            <?php
                                $options = array(
                                    '' => 'Live with pet',
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                );
                                $id = 'id="prof-live-with-pet"';
                                echo form_dropdown('prof-live-with-pet', $options, '', $id);
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="input" class="control-label">Fraternity/Sorority</label>
                        <div class="controls">
                            <?php
                                $options = array(
                                    '' => 'Greek life?',
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                );
                                $id = 'id="prof-frat"';
                                echo form_dropdown('prof-frat', $options, '', $id);
                            ?>
                        </div>
                    </div>
                </fieldset>
                </form>
                
                
        </div>

        <div id="step-2" style="width: 100%;">
                <p>Fill out the following form to set up package pickup settings</p>
                <form>
                    <fieldset>
                        <div class="control-group">
                            <label for="input" class="control-label">Receive Email Notifications</label>
                            <div class="controls">
                                <?php
                                    $options = array(
                                        '' => 'Email Notifications?',
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    );
                                    $id = 'id="pack-email"';
                                    echo form_dropdown('pack-email', $options, '', $id);
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input" class="control-label">Receive SMS Notifications</label>
                            <div class="controls">
                                <?php
                                    $options = array(
                                        '' => 'Text Message Notifications?',
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                    );
                                    $id = 'id="pack-sms"';
                                    echo form_dropdown('pack-sms', $options, '', $id);
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="input" class="control-label">Pack Pickup Security PIN #</label>
                            <div class="controls">
                                <input type="password" id="pack-pin" name="pack-pin" />
                            </div>
                        </div>
                    </fieldset>
                </form>
        </div>

</section>
<!-- /Wizard -->

</article>
</div>

<!-- Scripts -->
<!-- Smart wizard -->
<script type="text/javascript" src="<?= base_url(); ?>js/plugins/smartWizard/jquery.smartWizard-2.0.js"></script>
<script type="text/javascript" src="http://http://jqueryui.com/resources/demos/external/jquery.mousewheel.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<script type="text/javascript"> 
    
  
</script>
<style type="text/css">
    .ui-spinner-button:hover {cursor: pointer;}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#wizard').smartWizard();
        $('div a.buttonFinish').attr('href', '<?= base_url(); ?>index.php/tenant/process_profile');
        $('div a.buttonFinish').attr('onclick', 'processProfileCompletion();');
        
        
        // Set spinner inputs
        setSpinner('prof-academic-focus', 1, 10, 5); setSpinner('prof-neatness', 1, 10, 5);
        setSpinner('prof-tv', 1, 10, 5); setSpinner('prof-active', 1, 10, 5);
        setSpinner('prof-visitors', 1, 10, 5);
        
        function setSpinner(spinnerid, minval, maxval, initvalue) {
            $("#" + spinnerid).spinner({ min: minval, max: maxval }).val(initvalue);
        }
        
        
        $( ".slider-input" ).slider({
        range: "min",
        value: 5,
        min: 1,
        max: 10
        });
        
 $( ".slider-input" ).slider({
range: "min",
value: 37,
min: 1,
max: 700,
slide: function( event, ui ) {
$( "#amount" ).val( "$" + ui.value );
}
});
$( "#amount" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
    });
</script>