const ctx = document.getElementById('myChart');
const ctx1 = document.getElementById('myChart1');
const ctx2 = document.getElementById('myChart2');
// const ctx3 = document.getElementById('myChart3');
const ctx4 = document.getElementById('myChart4');
const ctx5 = document.getElementById('myChart5');


document.addEventListener("DOMContentLoaded", function() {
    var chartDataElement = document.getElementById('myChartContainer');
    var chartData = JSON.parse(chartDataElement.getAttribute('data-chart-data'));
    var chartData = JSON.parse(chartData);
    chart(chartData);

});

function chart(element){
/**************************** */
/****FLOUS PAR MOIS */
/**************************** */
console.log(typeof element["flousPmois"]);
console.log( element["flousPmois"]);
let flous = element["flousPmois"];
// Trier les clés de l'objet
const clesTrie = Object.keys(flous).sort((a, b) => a - b);

// Créer un tableau de paires clé-valeur triées
let floustableau = clesTrie.map(cle => ({ [cle]: flous[cle] }));
console.log(floustableau);

floustableau = floustableau.map(element => Object.values(element)[0]);

console.log(floustableau);


/**************************** */
/****COMMANDE PAR MOIS */
/**************************** */
console.log(typeof element["cmdPmois"]);
console.log( element["cmdPmois"]);
let cpm = element["cmdPmois"];
// Trier les clés de l'objet
const clesTriecpm = Object.keys(cpm).sort((a, b) => a - b);

// Créer un tableau de paires clé-valeur triées
let cpmtableau = clesTrie.map(cle => ({ [cle]: cpm[cle] }));
console.log(cpmtableau);

cpmtableau = cpmtableau.map(element => Object.values(element)[0]);

console.log(cpmtableau);


/********************************************* */
/********************************************* */
/* NBR CLIENT / COMMANDE / LIVREPDF / LIVRE REEL
/********************************************* */
/********************************************* */
var nbrLp = document.getElementById("lp");
var nbrLr = document.getElementById("lr");
var nbrCommande = document.getElementById("lcomm");
var nbrClient = document.getElementById("lclient");

nbrLp.innerText = element['lp'];
nbrLr.innerText = element['lr'];
nbrCommande.innerText = element['commande'];
nbrClient.innerText = element['client'];



//************************** */
//************************** */
/*var variables*/
//************************** */
//************************** */
/*****CHART 4 */
const labels4 = Object.keys(element['lpC']);
const val4 = Object.values(element['lpC']);
/*****CHART 5 */
const labels5 = Object.keys(element['lrC']);
const val5 = Object.values(element['lrC']);

//************************** */
//************************** */
/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 1                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */


    const labels =element['mois'];
    const data1 = {
      labels: labels,
      datasets: [{
        label: 'Janvier',
        data: floustableau,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        borderWidth: 1
      }]
    };
    
          
    new Chart(ctx1, {
        type: 'bar',
        data: data1,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      });

/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 2                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */
        


const data2 = {
    labels: labels,
    datasets: [{
      label: 'Janvier',
      data: cpmtableau,
      backgroundColor: [
        'rgb(5, 44, 207, 0.2)',
        'rgb(153, 102, 255, 0.2)',
        'rgb(54, 162, 235, 0.2)',
        'rgb(75, 192, 192, 0.2)',
        'rgb(255, 205, 86, 0.2)',
        'rgb(255, 159, 64, 0.2)',
        'rgb(255, 99, 132, 0.2)'
      ],
      borderColor: [   
      'rgb(5, 44, 207)',
      'rgb(153, 102, 255)',
      'rgb(54, 162, 235)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(255, 159, 64)',
      'rgb(255, 99, 132)'],
      borderWidth: 1
    }]
  };
    new Chart(ctx2, {
        type: 'bar',
        data: data2,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      });

/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 3                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */


/*const data3 = {
    labels: labels,
    datasets: [{
      label: 'My First Dataset',
      data: [65, 59, 80, 81, 56, 55, 40],
      fill: false,
      borderColor: 'rgb(75, 192, 192)',
      tension: 0.1
    }]
  };

new Chart(ctx3, {
    type: 'line',
    data: data3,        
  });
*/


/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 4                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */


const data4 = {
    labels: labels4,
    datasets: [{
      label: 'My First Dataset',
      data: val4,
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(153, 102, 255)',
        'rgb(255, 159, 64)',
        'rgb(255, 0, 255)',
        'rgb(0, 255, 255)'
        
      ],
      hoverOffset: 4
    }]
  };
          
    new Chart(ctx4, {
        type: 'doughnut',
        data: data4,        
      });


    




    /*  const data4 = {
        labels: [
          'January',
          'February',
          'March',
          'April'
        ],
        datasets: [{
          type: 'line',
          label: 'Bar Dataset',
          data: [10, 50, 30, 40],
          borderColor: 'rgb(255, 99, 132)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)'
        }, {
          type: 'line',
          label: 'Line Dataset',
          data: [5, 10, 50, 20],
          fill: false,
          borderColor: 'rgb(54, 162, 235)'
        }
        , {
          type: 'bar',
          label: 'Line Dataset',
          data: [115, 10, 50, 20],
          fill: false,
          borderColor: 'rgb(54, 162, 235)'
        }]
      };
      new Chart(ctx4, {
        type: 'scatter',
        data: data4,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      });*/



     

      
/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 5                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */



const data5 = {
    labels: labels5,
    datasets: [{
      label: 'My First Dataset',
      data: val5,
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(153, 102, 255)',
        'rgb(255, 159, 64)',
        'rgb(255, 0, 255)',
        'rgb(0, 255, 255)'
        
      ],
      hoverOffset: 4
    }]
  };
          
    new Chart(ctx5, {
        type: 'doughnut',
        data: data5,        
      });


    }