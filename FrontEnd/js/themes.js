function changeTheme(){



    let switcher = document.getElementById('theme-switcher');

    let text = switcher.innerHTML;

    let xhttp = new XMLHttpRequest();


    xhttp.onreadystatechange = function () {

        if (this.readyState == 4 && this.status == 200) {

            let theme = this.responseText;


            if (text === "<i class='fa fa-moon-o w3-margin-right'></i>" || theme === 'dark' ) {




                switcher.innerHTML = "<i class='fa fa-sun-o w3-margin-right'></i>";





                document.body.style.setProperty('background-color', '#191a1c', 'important');


                const sections = document.querySelectorAll('section');

                // Apply styles to each paragraph
                sections.forEach(section => {
                    section.style.setProperty('background-color', '#242527', 'important');
                    // Add more styles as needed
                });


                const paragraphs = document.querySelectorAll('p');

                // Apply styles to each paragraph
                paragraphs.forEach(paragraph => {
                    paragraph.style.setProperty('color', '#ffffff', 'important');
                    // Add more styles as needed
                });


                const h4Elements = document.querySelectorAll('h4');

                // Apply styles to each <h4> element
                h4Elements.forEach(h4 => {
                    h4.style.setProperty('color', '#ffffff', 'important');
                });

                // Select all <span> elements
                const spanElements = document.querySelectorAll('span');

                // Apply styles to each <span> element
                spanElements.forEach(span => {
                    span.style.setProperty('color', '#ffffff', 'important');
                });


                const h1Elements = document.querySelectorAll('h1');

                // Apply styles to each <h1> element
                h1Elements.forEach(h1 => {
                    h1.style.setProperty('color', '#ffffff', 'important');
                });


                const h6Elements = document.querySelectorAll('h6');

                // Apply styles to each <h1> element
                h6Elements.forEach(h6 => {
                    h6.style.setProperty('color', '#ffffff', 'important');
                });


                const t = document.querySelectorAll('textarea');

                // Apply styles to each <h1> element
                t.forEach(tx => {
                    tx.style.setProperty('background-color', 'rgba(40,36,36,0.07)', 'important');
                    tx.style.setProperty('color', 'rgb(255,255,255)', 'important');
                });


                document.getElementById('admin').style.color = 'red';
                document.getElementById('admin').style.fontWeight = 'normal';


                document.getElementById('header').style.setProperty('background-color', '#1b3c71', 'important');


                const anchors = document.querySelectorAll('a');

                // Apply styles to each <h1> element
                anchors.forEach(a => {
                    a.style.setProperty('background-color', '#1b3c71', 'important');

                });


                const buttons = document.querySelectorAll('button');

                // Apply styles to each <h1> element
                buttons.forEach(b => {
                    b.style.setProperty('background-color', '#1b3c71', 'important');

                });


                document.getElementById('copy').style.setProperty('background-color', '#1b3c71', 'important');

                document.getElementById('foot').style.setProperty('background-color', '#1b3c71', 'important');



            } // end of dark

            else if(text === "<i class='fa fa-sun-o w3-margin-right'></i>" || theme === 'light' ) {

                switcher.innerHTML = "<i class='fa fa-moon-o w3-margin-right'></i>";



                document.body.style.setProperty('background-color', '#f5f7f8', 'important');


                const sections = document.querySelectorAll('section');

                // Apply styles to each paragraph
                sections.forEach(section => {
                    section.style.setProperty('background-color', '#ffffff', 'important');
                    // Add more styles as needed
                });


                const paragraphs = document.querySelectorAll('p');

                // Apply styles to each paragraph
                paragraphs.forEach(paragraph => {
                    paragraph.style.setProperty('color', '#090909', 'important');
                    // Add more styles as needed
                });


                const h4Elements = document.querySelectorAll('h4');

                // Apply styles to each <h4> element
                h4Elements.forEach(h4 => {
                    h4.style.setProperty('color', '#090909', 'important');
                });

                // Select all <span> elements
                const spanElements = document.querySelectorAll('span');

                // Apply styles to each <span> element
                spanElements.forEach(span => {
                    span.style.setProperty('color', '#090909', 'important');
                });


                const h1Elements = document.querySelectorAll('h1');

                // Apply styles to each <h1> element
                h1Elements.forEach(h1 => {
                    h1.style.setProperty('color', '#ffffff', 'important');
                });


                const h6Elements = document.querySelectorAll('h6');

                // Apply styles to each <h1> element
                h6Elements.forEach(h6 => {
                    h6.style.setProperty('color', '#090909', 'important');
                });


                const t = document.querySelectorAll('textarea');

                // Apply styles to each <h1> element
                t.forEach(tx => {
                    tx.style.setProperty('background-color', 'white', 'important');
                    tx.style.setProperty('color', 'black', 'important');
                });


                document.getElementById('admin').style.color = 'red';
                document.getElementById('admin').style.fontWeight = 'normal';


                document.getElementById('header').style.setProperty('background-color', '#1a76d1', 'important');


                const anchors = document.querySelectorAll('a');

                // Apply styles to each <h1> element
                anchors.forEach(a => {
                    a.style.setProperty('background-color', '#1a76d1', 'important');

                });


                const buttons = document.querySelectorAll('button');

                // Apply styles to each <h1> element
                buttons.forEach(b => {
                    b.style.setProperty('background-color', '#1a76d1', 'important');

                });


                document.getElementById('copy').style.setProperty('background-color', '#1a76d1', 'important');

                document.getElementById('foot').style.setProperty('background-color', '#1a76d1', 'important');




            }







        }


    };// end of func

    xhttp.open("POST", "../../BackEnd/php/themes.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();





}