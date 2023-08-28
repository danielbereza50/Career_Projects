<%@ Page aspcompat=true %>
<%

'Sample Database Connection Syntax for ASP and SQL Server.

Dim oConn, oRs
Dim qry, connectstr
Dim db_name, db_username, db_userpassword
Dim db_server

db_server = "server name"
db_name = "db username"
db_username = "db username"
db_userpassword = "db password"
dim fieldname = "your_field"
dim tablename = "your_table"

connectstr = "Driver={SQL Server};SERVER=" & db_server & ";DATABASE=" & db_name & ";UID=" & db_username & ";PWD=" & db_userpassword
oConn = Server.CreateObject("ADODB.Connection")
oConn.Open(connectstr)

qry = "SELECT * FROM " & tablename

oRS = oConn.Execute(qry)

Do until oRs.EOF
   Response.Write(ucase(fieldname) & ": " & oRs.Fields(fieldname))
   oRS.MoveNext
Loop
oRs.Close


oRs = nothing
oConn = nothing
%> 
