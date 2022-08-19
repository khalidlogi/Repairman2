<?php
ob_start();
echo get_option('admin_email');

?>


<div class='container border border-secondary p-4'>
        <form class='form-group row' id='my_form'>

        <label  class='col-form-label' for='name'>Nom: </label>
        <input required class='form-control' id='name' type='text' name='name' >


    <label for="exampleSelect">Ville</label>
                    <select class="form-control" id="city" name=city>
                        <option value="Agadir">Agadir</option>
                        <option value="Al Hoceima">Al Hoceima</option>
                        <option value="Azilal">Azilal</option>
                        <option value="Beni Mellal">Beni Mellal</option>
                        <option value="Ben Slimane">Ben Slimane</option>
                        <option value="Boulemane">Boulemane</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Chaouen">Chaouen</option>
                        <option value="El Jadida">El Jadida</option>
                        <option value="El Kelaa des Sraghna">El Kelaa des Sraghna</option>
                        <option value="Er Rachidia">Er Rachidia</option>
                        <option value="Essaouira">Essaouira</option>
                        <option value="Fes">Fes</option>
                        <option value="Figuig">Figuig</option>
                        <option value="Guelmim">Guelmim</option>
                        <option value="Ifrane">Ifrane</option>
                        <option value="Kenitra">Kenitra</option>
                        <option value="Khemisset">Khemisset</option>
                        <option value="Khenifra">Khenifra</option>
                        <option value="Khouribga">Khouribga</option>
                        <option value="Laayoune">Laayoune</option>
                        <option value="Larache">Larache</option>
                        <option value="Marrakech">Marrakech</option>
                        <option value="Meknes">Meknes</option>
                        <option value="Nador">Nador</option>
                        <option value="Ouarzazate">Ouarzazate</option>
                        <option value="Oujda">Oujda</option>
                        <option value="Rabat-Sale">Rabat-Sale</option>
                        <option value="Safi">Safi</option>
                        <option value="Settat">Settat</option>
                        <option value="Sidi Kacem">Sidi Kacem</option>
                        <option value="Tangier">Tangier</option>
                        <option value="Tan-Tan">Tan-Tan</option>
                        <option value="Taounate">Taounate</option>
                        <option value="Taroudannt">Taroudannt</option>
                        <option value="Tata">Tata</option>
                        <option value="Taza">Taza</option>
                        <option value="Tetouan">Tetouan</option>
                        <option value="Tiznit">Tiznit</option>
                    </select></br>

<br>
        <label  class='col-form-label' for='email'>email: </label>
        <input required class='form-control' id='email' type='text' name='email' >

        <br>

        <label  class='col-form-label' for='tel'>tel: </label>
        <input required class='form-control mb-2' id='tel' value='000000' type='text' name='tel' >

        <br>

       
        <input type='hidden' name='action' value='my_action' >
        <input  required class='btn' id='submit_btn' type='submit' name='submit' value='submit'> 

    </form>
    <div id='res'></div>
    </div>

    <div id='response'>ajax responce will be here</div>

<?php

return ob_get_clean();