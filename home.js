document.querySelector("form").addEventListener("submit", search);

function jsonmovies(json){
    //json=JSON.parse(json);
    console.log(json);
    
    const container=document.getElementById('results');
    const loading = container.querySelector('.loading');
    loading.remove();

    if(json.results.length===0){
        notfound();
        return;
    }
    for(let movie in json.results){
        const card=document.createElement('div');

        card.dataset.id=json.results[movie].id;
        card.dataset.title=json.results[movie].title;
        card.dataset.description=json.results[movie].description;
        card.dataset.image=json.results[movie].image;
        card.dataset.like=0;
        card.classList.add('carta');

        const info_movie=document.createElement('div');
        info_movie.classList.add("info_movie");
        card.appendChild(info_movie);

        const img=document.createElement('img');
        img.src=json.results[movie].image;
        info_movie.appendChild(img);

        const movie_details=document.createElement('div');
        movie_details.classList.add("movie_details");
        info_movie.appendChild(movie_details);

        const info=document.createElement('div');
        info.classList.add("info");
        movie_details.appendChild(info);

        const title=document.createElement('strong');
        title.innerHTML=json.results[movie].title;
        info.appendChild(title);

        const description=document.createElement('a');
        description.innerHTML=json.results[movie].description;
        info.appendChild(description);

        container.appendChild(card);


        const like_icon=document.createElement('div');
        like_icon.classList.add("like_icon");
        info_movie.appendChild(like_icon);
        const like=document.createElement('img');
        like.src='./pics/nolike.png';
        like_icon.appendChild(like);


        //in questa parte noi facciamo una fetch per controllare se il film mostrato è già tra i preferiti per fare in modo che se la condizione è verificata
        //questo appaia col cuoricino pieno e con dataset.like=1;
        fetch("checkifmovieisliked.php?q="+card.dataset.id).then(onResponse).then(checkifmovieisliked);
        function checkifmovieisliked(json){
            console.log(json);
            if(json){
                card.dataset.like = 1;
                like.src = './pics/like.png';
            }else{
                card.dataset.like = 0;
                like.src = './pics/nolike.png';

            }
        }
        
      

        like.addEventListener('click', saveMovie);


    }
}

function onResponse(response) {
    //console.log(response);
    return response.json();
}


function saveMovie(event){
    const cuore=event.currentTarget;
    const card=cuore.parentNode.parentNode.parentNode;

    const formdata=new FormData();
    formdata.append('id', card.dataset.id);
    formdata.append('title', card.dataset.title);
    formdata.append('description', card.dataset.description);
    formdata.append('image', card.dataset.image);

    if(card.dataset.like=="1"){
        cuore.src='./pics/nolike.png';
        card.dataset.like=0;
        fetch("remove_movie.php?q="+card.dataset.id).then(dispatchResponse);
    }else{
        cuore.src='./pics/like.png';
        card.dataset.like=1;
        fetch("save_movie.php", {method:'post', body: formdata}).then(dispatchResponse);
    }

}


function dispatchResponse(response){
    console.log(response);
    return response.json().then(databaseResponse);
}



function databaseResponse(json){
    if(!json.ok){
        return null;
    }
}


function notfound(){
    const container=document.getElementById('results');
    container.innerHTML='';
    const avviso=document.createElement('div');
    avviso.textContent="Spiacenti, nessun risultato.";
    container.appendChild(avviso);
}

function search(event){
    //leggo ciò che ho inserito nella barra di ricerca e mando tutto alla pagina php che si occuperà di fare la richiesta api
    const container=document.getElementById('results');
    container.innerHTML='';
    const loading=document.createElement('img');
    loading.src="./pics/loading.gif";
    loading.classList.add("loading");
    results.appendChild(loading);
    const text=document.getElementsByName("search")[0].value;
    console.log(encodeURIComponent(text));
    fetch("cerca_film.php?q="+encodeURIComponent(text)).then(searchResponse).then(jsonmovies);
    event.preventDefault();
}



function searchResponse(response){
    console.log(response);
    return response.json();
}
