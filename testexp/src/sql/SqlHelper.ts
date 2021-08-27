import SqlConnection from '../../server'

export default class MysqlHelper {
    static selectAll (table: string) : void {
        SqlConnection.connect()
        SqlConnection.query('SELECT * FROM ' + table )
    }
}