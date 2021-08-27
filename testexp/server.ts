import mysql from 'mysql'

const SqlConnection: mysql.Connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: 'testdb'
})

export default SqlConnection



