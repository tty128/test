import Aa from './test'

const a = new Aa()

test('aa() is hello?', () => {
  expect(a.aa()).toBe('hello')
})

test('bb() is hello?', () => {
  expect(a.bb()).toBe('hello')
})
