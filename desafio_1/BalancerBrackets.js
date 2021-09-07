
const isBalanced = (brackets) => {
	let stack = [];

	if ((brackets.length % 2) !== 0) {
		return false;
    } 
    
	for (let i = 0; i < brackets.length; i++) { 
		switch(brackets.charAt(i)) {
            case '{':
                stack.push('{');
                break;
            case '[': 
                stack.push('[');
                break;
			case '(':
				stack.push('(');
                break;
                
            case '}':
                if (stack.pop() != '{') {
                    return false;
                }
                break;
            case ']':
                if (stack.pop() != '[') {
                    return false;
                }
                break;
            case ')':
                if (stack.pop() != '(') {
                    return false;
                }
                break;
		}
	}
	return true;
}

export default isBalanced;
