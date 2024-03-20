<style>
    #catalogue {
        display: flex;
        flex-direction: column;
        gap: 20px;
        font-size: 20px;
        width: 100%;
    }
    #catalogue .row {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    #catalogue .button {
        border-radius: 10px;
        height: 50px;
        min-width: 200px;
        background-color: var(--secondary-color);
        margin: 0 10px;
    }
    #catalogue .button:hover {
        background-color: var(--background-color1);
    }
</style>
<div id="catalogue">
    <div class="row">
        <a href="/products?type=procesory" class="button">Procesory</a>
        <a href="/products?type=zakladne_dosky" class="button">Zakladné dosky</a>
        <a href="/products?type=disky" class="button">Disky</a>
        <a href="/products?type=skrine" class="button">Skrine</a>
    </div>
    <div class="row">
        <a href="/products?type=ram" class="button">RAM</a>
        <a href="/products?type=graficke_karty" class="button">Grafické karty</a>
        <a href="/products?type=chladenie" class="button">Chladenie</a>
        <a href="/products?type=zdroje" class="button">Zdroje</a>
    </div>
</div>