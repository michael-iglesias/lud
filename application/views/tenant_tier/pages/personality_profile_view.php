<div id="study" class="question">
    <div class="question-header">
        <h3>Very Studious?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/study.jpg" />
    <br /><br />
    <button onclick="personalityProfile('study', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('study', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="neat" class="question hide">
    <div class="question-header">
        <h3>Neat Freak?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/neat.jpg" />
    <br /><br />
    <button onclick="personalityProfile('neat', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('neat', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="smoke" class="question hide">
    <div class="question-header">
        <h3>Do you smoke?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/smoke.jpg" />
    <br /><br />
    <button onclick="personalityProfile('smoke', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('smoke', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>
    
<div id="party" class="question hide">
    <div class="question-header">
        <h3>Party Animal?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/party.jpg" />
    <br /><br />
    <button onclick="personalityProfile('party', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('party', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="chef" class="question hide">
    <div class="question-header">
        <h3>Are You A Master Chef?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/male_chef.jpg" />
    <br /><br />
    <button onclick="personalityProfile('chef', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('chef', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>


<div id="gym" class="question hide">
    <div class="question-header">
        <h3>You Hit The Gym?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/gym.jpg" />
    <br /><br />
    <button onclick="personalityProfile('gym', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('gym', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="sports" class="question hide">
    <div class="question-header">
        <h3>Sports Fan?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/sports.jpg" />
    <br /><br />
    <button onclick="personalityProfile('sports', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('sports', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="movies" class="question hide">
    <div class="question-header">
        <h3>Movie Buff?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/movie.jpg" />
    <br /><br />
    <button onclick="personalityProfile('movies', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('movies', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="pets" class="question hide">
    <div class="question-header">
        <h3>Small Furry Animals?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/pets.jpg" />
    <br /><br />
    <button onclick="personalityProfile('pets', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('pets', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="tv" class="question hide">
    <div class="question-header">
        <h3>Watch Tv?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/tv.jpg" />
    <br /><br />
    <button onclick="personalityProfile('tv', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('tv', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="greek" class="question hide">
    <div class="question-header">
        <h3>Greek Life?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/frat.jpg" />
    <br /><br />
    <button onclick="personalityProfile('greek', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('greek', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>

<div id="ati" class="question hide">
    <div class="question-header">
        <h3>Above The Influence?</h3>
    </div>
    <img src="<?= base_url(); ?>img/personality/ati.gif" />
    <br /><br />
    <button onclick="personalityProfile('ati', 'yes');" class="btn btn-flat btn-warning btn-large btn-personality">Me</button>
    <button onclick="personalityProfile('ati', 'no');" class="btn btn-flat btn-danger btn-large btn-personality">Not Me</button>
</div>


<div id="personality-profile-complete" class="hide alert alert-success">
    <button type="button" data-dismiss="alert" class="close">×</button>
    <strong>Completed!</strong> Personality Profile Complete. We will now strive towards matching you with the best roommates possible.
</div>


<input type="hidden" id="studyVal" />
<input type="hidden" id="neatVal" />
<input type="hidden" id="smokeVal" />
<input type="hidden" id="partyVal" />
<input type="hidden" id="chefVal" />
<input type="hidden" id="gymVal" />
<input type="hidden" id="sportsVal" />
<input type="hidden" id="moviesVal" />
<input type="hidden" id="petsVal" />
<input type="hidden" id="tvVal" />
<input type="hidden" id="greekVal" />
<input type="hidden" id="atiVal" />


<style>
    .question {
        text-align: center;
        margin: 0 auto;
    }
    .question-header {
        background: none repeat scroll 0 0 #FA9300;
        
        padding: 14px;
        margin-bottom: 7px;
    }
    .question-header h3 {
        color: white;
        font-weight: bolder;
    }
    .btn-personality {
        padding: 15px;
        width: 135px;
        font-size: 18px;
    }
</style>