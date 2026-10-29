document.addEventListener("DOMContentLoaded", function(){


    const configureBtn = document.querySelector(".configure-btn");


    if(configureBtn){

        configureBtn.addEventListener("click",function(){

            window.location.href="point_policy.php";

        });

    }


    const buttons = document.querySelectorAll("button");


    buttons.forEach(button=>{


        button.addEventListener("click",function(){


            this.style.transform="scale(0.95)";


            setTimeout(()=>{

                this.style.transform="";

            },150);


        });


    });



});


document.addEventListener('DOMContentLoaded', function(){

    const searchInput = document.getElementById('activitySearch');
    const table = document.getElementById('allocationTable');

    if(searchInput && table){

        const rows = table.querySelectorAll('tbody tr');

        searchInput.addEventListener('keyup', function(){

            const keyword = this.value.toLowerCase();

            rows.forEach(function(row){

                const rowText = row.textContent.toLowerCase();

                if(rowText.includes(keyword)){
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }

            });

        });

    }

});