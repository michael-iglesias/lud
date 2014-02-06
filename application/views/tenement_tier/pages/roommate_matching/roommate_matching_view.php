<div class="row">
    <div id="studious" class="span1 roommate-matching-select-filter" onclick="loadFilteredTenants('studious');">
        <center><h5>Studious</span></h5>
        <img src="<?= base_url(); ?>img/personality/study.jpg" width="75px" width="55px" />
    </div>
    
    <div id="neat" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('neat');">
        <center><h5>Neat Freak</span></h5>
        <img src="<?= base_url(); ?>img/personality/neat.jpg" width="75px" width="55px" />
    </div>
    
    <div id="smoke" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('smoke');">
        <center><h5>Smoke</span></h5>
        <img src="<?= base_url(); ?>img/personality/smoke.jpg" width="75px" width="55px" />
    </div>
    
    <div id="party" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('party');">
        <center><h5>Party</span></h5>
        <img src="<?= base_url(); ?>img/personality/party.jpg" width="75px" width="55px" />
    </div>
    
    <div id="chef" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('chef');">
        <center><h5>Chef</span></h5>
        <img src="<?= base_url(); ?>img/personality/male_chef.jpg" width="75px" width="55px" />
    </div>
    
    <div id="gym" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('gym');">
        <center><h5>Gym</span></h5>
        <img src="<?= base_url(); ?>img/personality/gym.jpg" width="75px" width="55px" />
    </div>
    
    <div id="sports" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('sports');">
        <center><h5>Sports Fan</span></h5>
        <img src="<?= base_url(); ?>img/personality/sports.jpg" width="75px" width="55px" />
    </div>
    
    <div id="movies" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('movies');">
        <center><h5>Movie Buff</span></h5>
        <img src="<?= base_url(); ?>img/personality/movie.jpg" width="75px" width="55px" />
    </div>

    <div id="pets" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('pets');">
        <center><h5>Pets</span></h5>
        <img src="<?= base_url(); ?>img/personality/pets.jpg" width="75px" width="55px" />
    </div>
    
    <div id="tv" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('tv');">
        <center><h5>Tv</span></h5>
        <img src="<?= base_url(); ?>img/personality/tv.jpg" width="75px" width="55px" />
    </div>
    
    <div id="greek" class="span1 roommate-matching-select-filter" style="margin-left: 10px;" onclick="loadFilteredTenants('greek');">
        <center><h5>Greek Life</span></h5>
        <img src="<?= base_url(); ?>img/personality/frat.jpg" width="75px" width="55px" />
    </div>
    
    <input type="hidden" id="studious-val" value="no" />
    <input type="hidden" id="neat-val" value="no" />
    <input type="hidden" id="smoke-val" value="no" />
    <input type="hidden" id="party-val" value="no" />
    <input type="hidden" id="chef-val" value="no" />
    <input type="hidden" id="gym-val" value="no" />
    <input type="hidden" id="sports-val" value="no" />
    <input type="hidden" id="movies-val" value="no" />
    <input type="hidden" id="tv-val" value="no" />
    <input type="hidden" id="greek-val" value="no" />
    <input type="hidden" id="pets-val" value="no" />
    
    <hr />
    
    <!-- Display Tenement Towers/Units -->
    <?php if($tenement_towers != FALSE): ?>
        <?php foreach($tenement_towers as $row): ?>
            <div class="span2 building-box" style="text-align: center;">
                <h3>Building: <?= $row['tow_name']; ?></h3>
                <ul style="text-align: left;">
                    <li># of Units: <b><?= $row['tow_units_per_floor'] * $row['tow_floor_count']; ?></b></li>
                    <li># of Units With Vacancies: 
                        <?php if($row['units_with_vacancies'] != 0): ?>
                            <span style="color: green; font-weight: bold;"><?= $row['units_with_vacancies']; ?></span>
                        <?php else: ?>
                            <span style="color: red; font-weight: bold;"><?= $row['units_with_vacancies']; ?></span>
                        <?php endif; ?>
                    </li>
                </ul>
                <a class="btn btn-wuxia btn-warning" href="<?= base_url(); ?>index.php/tenement/manage_building/<?= $row['tow_id']; ?>">Select Building</a>
                <p>&nbsp;</p>
            </div>    
        <?php endforeach; ?>
    <?php else: ?>
    <div class="span12"><h1>Property Has Not Added Any Buildings</h1></div>

    <?php endif; ?>
    <!-- ***END Display Tenement Towers/Units -->
    
    <div id="filtered-tenant-list" class="span12">
        asdf
        
    </div>
    
    
</div>




<style>
    .roommate-matching-select-filter {
        padding: 5px;
        border: 2px solid #a0a0a0;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        margin-left: 4px;
    }
    .roommate-matching-select-filter img {height: 55px;}
    .roommate-matching-select-filter:hover, .roommate-matching-select-filter-active {
        cursor: pointer;
        padding: 5px;
        border: 2px solid #FA9300;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
    }
    .roommate-matching-select-filter-selected {
        cursor: pointer;
        padding: 5px;
        border: 2px solid #FA9300;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
    }
</style>
<script>
    function loadFilteredTenants(attr) {
        $('#'+attr).toggleClass("roommate-matching-select-filter-active");
        
        if( $('#' + attr + '-val').val() == 'no') {
            $('#' + attr + '-val').val('yes');
        } else {
            $('#' + attr + '-val').val('no');
        }
        var study = $('#studious-val').val(); var neat = $('#neat-val').val();
        var smoke = $('#smoke-val').val(); var party = $('#party-val').val();
        var chef = $('#chef-val').val(); var gym = $('#gym-val').val();
        var sports = $('#sports-val').val(); var movies = $('#movies-val').val();
        var tv = $('#tv-val').val(); var greek = $('#greek-val').val(); var pets = $('#pets-val').val();
        
        
        $.ajax({
            type: "POST",
            url: 'roommate_matching/load_narrowed_roommate_profile_results/',
            data: {study: study, neat: neat, smoke: smoke, party: party, chef: chef, gym: gym, sports: sports, movies: movies, tv: tv, greek: greek, pets: pets},
            success: function(data) {
                if(data != 0) {
                    $('#filtered-tenant-list').html(data);
                }
            }, 
            error: function() {
                    alert('System Error! Please try again.');
            },
            complete: function() {
                    console.log('completed')
            }
        }); // ***END $.ajax call
        
        
        
    }


</script>