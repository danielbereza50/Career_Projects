When ever doing UX from scratch, use the following start to the code:

<style>
    
    .flex-wrapper {display: flex;flex-wrap: wrap;justify-content: space-between; align-items: center;}
    
    .flex-item {width: 32%;height: auto;}
    
    
    @media screen and (max-width:980px){width: 50%;height: auto;}
    
    @media screen and (max-width:767px){width: 100%;height: auto;}
    
    
</style>

    <div class = "flex-wrapper">

    <div class = "flex-item">

    <!-- remaining divs go here -->

    </div>

    </div>
