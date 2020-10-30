import React from 'react';

import Raider from './Raider';

const RaiderList = (props) => {
    console.log(props.raiders);
    return (
        <table className="raiderList">
            <thead><Raider img={undefined} name="Name" timezone="Timezone" startTime="Start Time" /></thead>
            <tbody>
                {
                    props.raiders.map(raider => {
                        return (<Raider img={props.img} name={raider.name} timezone={raider.timezone} startTime={raider.startTime} />);
                    })
                }
            </tbody>
        </table>
    )
}

export default RaiderList;