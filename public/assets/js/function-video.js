$(function(){

    const $videoDetail = $('#video-detail');
    const $videoTarget = $('#video-target');
    let autoplay       = ''; 

    $videoDetail.on('click', 'a.stretched-link', function(e){
        e.preventDefault();
        let $el = $(this);
        let $el_row = $el.closest('.row');


        let title       = $el_row.find('.text-video-title');
        let description = $el_row.find('.text-video-description');
        let actions     = $el_row.find('.video-actions');

        $videoTarget.html(`
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" 
                    src="https://www.youtube.com/embed/${ $el.data('video-code') }?rel=0${ autoplay }" 
                    allow="accelerometer; autoplay; encrypted-media; gyroscope;" 
                    allowfullscreen></iframe>
            </div>
            <h3 class="card-title m-t-30">${ title.text() }</h3>
            <p>${ description.text() }</p> 
            
            ${actions.html()}
        `);

        autoplay = '&autoplay=1';

        $('body').registerEventPassparameter();

    });

    $videoDetail.find('a.stretched-link').first().trigger('click');
    
});