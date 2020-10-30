import React from 'react';

const Raider = (props) => {
    return (
        <tr>
            <td><img src={props.img} /></td>
            <td contentEditable="true">{props.name}</td>
            <td contentEditable="true">{props.timezone}</td>
            <td contentEditable="true">{props.startTime}</td>
        </tr>
    );
}

export default Raider;