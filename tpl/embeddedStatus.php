<style type="text/css">
    .embedded {
        display: inline-block;
        position: relative;
    }
    
    .embedded .elogo {
        margin: 0 auto;
        border: none;
    }
    
    .embedded .estatus {
        display: block;
        width: 100%;
        text-align: center;
        position: absolute;
        margin-top: 30%;
        font-size: 48px;
        font-weight: bold;
        top: 0;
        left: 0;
        color: #222;
        font-family: Verdana, Helvetica, Arial;
        text-transform: uppercase;
    }
    
    
    .fadeable {
        transition: opacity 2s;
        -moz-transition: opacity 2s; /* Firefox 4 */
        -webkit-transition: opacity 2s; /* Safari and Chrome */
        -o-transition: opacity 2s; /* Opera */
        -ms-transition: opacity 2s;
    }
    
    .faded {
        opacity: 0;
    }
    
    .unfaded {
        opacity: 1;
    }
    
    a {
        text-decoration: none;
    }
    
</style>

<script type="text/javascript">


    
    document.addEventListener("DOMContentLoaded", function () {
        
        
        NodeList.prototype.addClass = HTMLCollection.prototype.addClass = function (className) {
            var classes,
                objectClass,
                i,
                classIndex;
                
            for (i = 0; i < this.length; i++) {
                objectClass = this[i].className,
                classes = objectClass.split(" ");
                for (classIndex = 0; classIndex < classes.length; classIndex++) {
                    if (classes[classIndex] === className) {
                        return;
                    }
                }
                
                this[i].className = objectClass + " " + className;
            }
        };
        
        NodeList.prototype.removeClass = HTMLCollection.prototype.removeClass = function (className) {
            var classes,
                objectClass,
                i,
                classIndex,
                newClasses = "",
                oldClass;
                
            for (i = 0; i < this.length; i++) {
                objectClass = this[i].className,
                classes = objectClass.split(" ");
                for (classIndex = 0; classIndex < classes.length; classIndex++) {
                    oldClass = classes[classIndex];
                    if (classes[classIndex] !== className) {
                        newClasses = newClasses + " " + oldClass;
                    }
                }
                
                this[i].className = newClasses;
            }
        };
        
        var embeddeds = document.getElementsByClassName("embedded"),
            allLogos = document.getElementsByClassName("elogo"),
            allStatii = document.getElementsByClassName("estatus"),
            resetable = false;
           
            embedMouseEnter = function (e) {
                if (!resetable) {
                    return;    
                }
                resetable = false;
                var target = this;
                eLogos = target.getElementsByClassName("elogo"),
                eStatii = target.getElementsByClassName("estatus"),
                eLogos.removeClass("faded");        
                eLogos.addClass("unfaded");        
                eStatii.removeClass("unfaded");   
                eStatii.addClass("faded");
                reset();
            },
            i = 0,
            reset = function () {
                setTimeout(function() {

                    allLogos.removeClass("unfaded");
                    allLogos.addClass("faded");
                    
                    setTimeout(function () {
                        allStatii.removeClass("faded");
                        allStatii.addClass("unfaded");
                        resetable = true;
                    }, 2000);
                    
                },3000);    
            };
        
        for (i = 0 ; i < embeddeds.length; i++) {
            embeddeds[i].addEventListener('mouseover', embedMouseEnter);
        }

        reset();
        
    });
</script>

<a class="embedded" href="<?= $ini_array['base_url'] ?>" target="_top">
    <img class="elogo fadeable" src="/images/HWHABY_logo_218.png" alt="Have We Had a Baby Yet?">
    <div class="estatus fadeable faded"><?php echo $account->getBorn() ?></div>
</a>