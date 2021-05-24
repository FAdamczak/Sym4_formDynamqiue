$(function(){
    
    $pays = $('#geo_pays');
    $ville = $("#geo_ville");

    setVille();
    setMonument();

    $pays.change(function(){    
        var $form = $(this).closest('form');
        var data = {};
        data[$pays.attr('name')] = $pays.val();
        $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            success: function(html) {
                $('#geo_ville').replaceWith(
                    $(html).find('#geo_ville')
                );
                setUpChangeVille(); 
                setVille();
            }
        });
    })
    
    setUpChangeVille();

    function setUpChangeVille() {
        $ville = $("#geo_ville");
        $pays = $('#geo_pays');
        $ville.change(function(){
            var $form = $(this).closest('form');
            var data = {};
            data[$ville.attr('name')] = $ville.val();
            data[$pays.attr('name')] = $pays.val();
            $.ajax({
                url : $form.attr('action'),
                type: $form.attr('method'),
                data : data,
                success: function(html) {
                    $('#geo_monument').replaceWith(
                        $(html).find('#geo_monument')
                    );
                    setMonument();
                }
            });
        });
    }

    function setVille() {
        $('#geo_ville option:eq(1)').prop('selected', true);
        $('#geo_ville').trigger('change');
        setMonument();
    }

    function setMonument() {
        $('#geo_monument option:eq(1)').prop('selected', true);
    }

    


    

});

