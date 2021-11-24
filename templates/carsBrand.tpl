{include file="templates/headerBrand.tpl"}

{*Navs diferentes para los templates*}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="login">Login</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        {if $admin == 3}
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="visitHome">Home</a>
            </li>  
        {else if $admin == 1 || $admin == 0}
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{BASE_URL}">Home</a>
            </li>
        {/if} 
        <li class="nav-item"> 
          {foreach from=$title item=$cars}
            <a class="nav-link disabled"  tabindex="-1" aria-disabled="true">{$cars->brand}</a>      
          {/foreach}
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="card-group">
    {*Traigo los autos por marca*}
    {foreach from=$carsBrand item=$cars}
      <div class="card" style="max-width: 18rem;">
        {*Traigo las imagenes de los autos, si el nombre del auto por marca es igual al nombre del auto por imagen*}
        {foreach from=$carsImg item=$img}
          {if $cars->car == $img->carImg}
            <img src="images/cars/{$img->name}" class="card-img-top {if $cars->sold} sold {/if}" alt="{$cars->car}">
          {/if} 
        {/foreach}
        <div class="card-body {if $cars->sold} sold {/if}">
          {if !$cars->sold}
              {if $admin == 3}                           
                <h5 class="card-title"><a href="visitDescription/{$cars->id}">{$cars->car}</a></h5>
              {else if $admin == 1 || $admin == 0}
                <h5 class="card-title"><a href="description/{$cars->id}">{$cars->car}</a></h5>
              {/if} 
              <p class="card-text">{$cars->description|truncate:50}</p>
              <p class="card-text"><small class="text-muted">Year: {$cars->year}</small></p>
              {if $admin == 1}
                <a href="deleteCar/{$cars->brand}/{$cars->id}/{$cars->car}" class="btn btn-danger">Delete</a>
                <a href="onSaleCar/{$cars->brand}/{$cars->id}" class="btn btn-primary">Sold</a>
              {/if} 
          {else}
              <h5 class="card-title"><a href="description/{$cars->id}">{$cars->car}</a></h5>
              <p class="card-text">{$cars->description|truncate:50}</p>
              <p class="card-text"><small class="text-muted">Year: {$cars->year}</small></p>
              {if $admin == 1}
                <a href="deleteCar/{$cars->brand}/{$cars->id}/{$cars->car}" class="btn btn-danger">Delete</a>
                <a href="soldCar/{$cars->brand}/{$cars->id}" class="btn btn-primary">Restore</a>
              {/if} 
          {/if}           
        </div>
      </div>
      
    {/foreach}
</div>

{include file="templates/footer.tpl"}