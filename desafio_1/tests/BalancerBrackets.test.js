//import isBalanced from './BalancerBrackets.js'
import isBalanced from "../BalancerBrackets.js";

test('validating correct balanced brackets', () => {
  expect(isBalanced('(){}[]')).toBe(true);
  expect(isBalanced('[{()}](){}')).toBe(true);
  expect(isBalanced('(()((())()))')).toBe(true);
  expect(isBalanced('{}{({[]}[])[]}')).toBe(true);
  expect(isBalanced('(()((([({})]))()))')).toBe(true);
  expect(isBalanced('(()((())()))')).toBe(true);
});

test('validating incorrect balanced brackets', () => {
  expect(isBalanced('{{{{}(()((())()))')).toBe(false);
  expect(isBalanced('[]{()')).toBe(false);
  expect(isBalanced('[{)]')).toBe(false);
});
