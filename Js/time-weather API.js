const weatherApiKey = '46fa4f1d823046369342dd031b68b847';


async function fetchTime() {
    try {
        const response = await fetch('http://worldtimeapi.org/api/ip');
        const data = await response.json();
        const timeElement = document.getElementById('time');
        timeElement.innerText = `Current Time: ${new Date(data.datetime).toLocaleString()}`;
        timeElement.style.color = '#fff';
        timeElement.style.fontSize = '14px'
    } catch (error) {
        console.error('Error fetching time:', error);
        document.getElementById('time').innerText = 'Could not fetch time data.';
    }
}


async function fetchWeather() {
    try {
        const response = await fetch(`https://api.weatherbit.io/v2.0/current?city=Cambridge&key=${weatherApiKey}&units=M`);
        
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log(data); 
        const weatherElement = document.getElementById('weather');
        weatherElement.innerText = `Current Weather in Cambridge: ${data.data[0].weather.description}, ${data.data[0].temp}°C`;
        weatherElement.style.color = '#fff';
        weatherElement.style.fontSize = '14px';
    } catch (error) {
        console.error('Error fetching weather:', error);
        document.getElementById('weather').innerText = 'Could not fetch weather data.';
    }
}


window.onload = () => {
    fetchTime();
    fetchWeather();
};
