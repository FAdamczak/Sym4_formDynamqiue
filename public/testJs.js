$(function(){
    
    var str_villes = $('#lesDatas')[0].dataset.villes;
    var str_mon = $('#lesDatas')[0].dataset.monuments;
    
    villes = [];
    monuments = [];

    var t_villes = str_villes.split("+++");
    t_villes.forEach(ligne => {
        t_ligne = ligne.split("***");
        var ville = [];
        ville[0] = t_ligne[0];
        ville[1] = t_ligne[1];
        ville[2] = t_ligne[2];
        villes.push(ville);
    });
    villes.pop();  

    var t_mon = str_mon.split("+++");
    t_mon.forEach(ligne=> {
        t_ligne = ligne.split("***");
        var mon = [];
        mon[0] = t_ligne[0];
        mon[1] = t_ligne[1];
        mon[2] = t_ligne[2];
        monuments.push(mon);
    });
    monuments.pop();

    updateVilles();
    updateMonuments();

    $('#pays_nom').change(function(){
        $('#villes').empty();
        $('#monuments').empty();
        updateVilles();
        updateMonuments();
    });

    $('#villes').change(function(){
        $('#monuments').empty();
        updateMonuments();
    });
});

function updateVilles() {
    const pays = $('#pays_nom').val();
    villes.forEach(ville => {
        if (ville[2] == pays) {
            optText = ville[1];
            optValue = ville[0];
            $('#villes').append(new Option(optText, optValue));
        }
    })
    var elt = $('#villes');
}

function updateMonuments() {
    const ville = $('#villes').val();
    monuments.forEach(mon => {
        if(mon[2] == ville) {
            optText = mon[1];
            optValue = mon[0];
            $('#monuments').append(new Option(optText, optValue));
        }
    })
}