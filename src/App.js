import logo from './logo.svg';
import './App.css';

import RaiderList from './raidsquad/RaiderList';

function App() {
    console.log("TEST");
    return (
        <div className="App">
        <RaiderList img="tank.png" raiders={[{name: "Jean", timezone: "UTC+0", startTime: "18:00"}, {name: "Shia", timezone: "UTC+1", startTime: "19:00"}]} />
            <RaiderList img="heal.png" raiders={[{name: "Masya", timezone: "UTC+0", startTime: "18:00"}, {name: "Historia", timezone: "UTC+3", startTime: "21:00"}]} />
            <RaiderList img="mdps.png" raiders={[{name: "Saidi", timezone: "UTC+1", startTime: "19:00"}, {name: "Valen", timezone: "UTC+3?", startTime: "21:00?"}]} />
            <RaiderList img="rdps.png" raiders={[{name: "Auri", timezone: "UTC+1", startTime: "19:00"}, {name: "Kai", timezone: "UTC+3?", startTime: "21:00?"}]} />
        </div>
    );
}

export default App;
