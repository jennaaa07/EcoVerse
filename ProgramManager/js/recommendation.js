document.addEventListener("DOMContentLoaded", () => {

    const deployBtn = document.querySelector(".deploy-btn");
    const approveBtn = document.querySelector(".approve-btn");

    if(deployBtn){

        deployBtn.addEventListener("click", function(){

            const confirmDeploy = confirm(
                "Automatically stage this recommended campaign?"
            );

            if(confirmDeploy){

                alert("Recommendation has been staged successfully.");

            }

        });

    }

    if(approveBtn){

        approveBtn.addEventListener("click", function(){

            const answer = confirm(
                "Approve these AI-generated point adjustments?"
            );

            if(answer){

                alert("Point allocation has been updated.");

            }

        });

    }


    const cards = document.querySelectorAll(".recommend-card");

    cards.forEach(card=>{

        card.addEventListener("mouseenter",()=>{

            card.style.transform="translateY(-4px)";
            card.style.transition=".25s";

        });

        card.addEventListener("mouseleave",()=>{

            card.style.transform="translateY(0px)";

        });

    });

});