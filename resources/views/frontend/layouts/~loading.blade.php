<!--<div class="loading-spiner-holder" id="loading_div" data-loading >
    <span class="procesare">Se incarca ...</span>
    <div class="loading-spiner">
        <div class="loading-spinner"></div>
    </div>
</div>-->
<style>
    #loading_div {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        z-index:1000;
        background-color:#323744;
        opacity: 0.5;
        transition: all 1s ease-in-out;
        -webkit-animation-iteration-count: infinite;
        -moz-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        -webkit-animation-name: fade;
        -moz-animation-name: fade;
        animation-name: fade;
        -webkit-animation-timing-function: linear;
        -moz-animation-timing-function: linear;
        animation-timing-function: linear;
}
    }
    @-webkit-keyframes fade {
        0%   { opacity: 0; }
        100% { opacity: 1; }
    }
    @-moz-keyframes fade {
        0%   { opacity: 0; }
        100% { opacity: 1; }
    }
    @-o-keyframes fade {
        0%   { opacity: 0; }
        100% { opacity: 1; }
    }
    @keyframes fade {
        0%   { opacity: 0; }
        100% { opacity: 1; }
    }
    .ajax-loader {
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -32px; /* -1 * image width / 2 */
        margin-top: -32px;  /* -1 * image height / 2 */
        display: block;
    }
</style>