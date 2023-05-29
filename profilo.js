fetch("mostra_preferiti.php").then(onResponse).then(mostraJson);


function onResponse(response){
    console.log(response);
    if(!response.ok){
        return null
    };
    return response.json();
}

function mostraJson(json){
    console.log(json);
    const container=document.getElementById('results');
    container.innerHTML='';

    if(json.length==0){
        notfound();
        return;
    }

    for(let movie in json){
 

        const card=document.createElement('div');
        card.dataset.id=json[movie].id;
        card.classList.add('carta');
        const info_movie=document.createElement('div');
        info_movie.classList.add("info_movie");
        card.appendChild(info_movie);

        const img=document.createElement('img');
        img.src=json[movie].image;
        info_movie.appendChild(img);

        const movie_details=document.createElement('div');
        movie_details.classList.add("movie_details");
        info_movie.appendChild(movie_details);

        const info=document.createElement('div');
        info.classList.add("info");
        movie_details.appendChild(info);

        const title=document.createElement('strong');
        title.innerHTML=json[movie].title;
        info.appendChild(title);

        const description=document.createElement('a');
        description.innerHTML=json[movie].description;
        info.appendChild(description);

        container.appendChild(card);


        const action_icon=document.createElement('div');
        action_icon.classList.add("action_icon");
        info_movie.appendChild(action_icon);
        const remover=document.createElement('button');
        remover.textContent="Rimuovi";
        action_icon.appendChild(remover);

        remover.addEventListener('click', elimina);

    }

}


function elimina(event){
    const bottone=event.currentTarget;
    const card=bottone.parentNode.parentNode.parentNode;
    card.remove();
    fetch("remove_movie.php?q="+card.dataset.id).then(onResponse);
}