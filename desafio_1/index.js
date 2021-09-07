import isBalanced from './BalancerBrackets.js'
import pkg from 'prompt';
const { start, get } = pkg;

const properties = [
    {
        name: 'brackets',
        validator: /^[\{\}\[\]\(\)]+$/,
        warning: "Input must be only '{', '}', '[', ']', '(' and ')'"
    }
];

start();
console.log('Insert the brackets sequence:');

get(properties, function (err, result) {
    if (err) { 
        console.log(err);
        return true;
    }
    console.log('Your brackets are ' + (isBalanced(result.brackets)?'valid':'not valid'));
});