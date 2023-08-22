<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<!--#include file="Connections/connAdmin.asp" -->
<% If (CStr(Request("XYzy")) = "goaway") Then %>
<%
Dim MM_editAction
MM_editAction = CStr(Request.ServerVariables("SCRIPT_NAME"))
If (Request.QueryString <> "") Then
  MM_editAction = MM_editAction & "?" & Server.HTMLEncode(Request.QueryString)
End If

' boolean to abort record edit
Dim MM_abortEdit
MM_abortEdit = false
%>
<%
' IIf implementation
Function MM_IIf(condition, ifTrue, ifFalse)
  If condition = "" Then
    MM_IIf = ifFalse
  Else
    MM_IIf = ifTrue
  End If
End Function
%>
<%
If (CStr(Request("MM_insert")) = "form1") Then
  If (Not MM_abortEdit) Then
    ' execute the insert
    Dim MM_editCmd

    Set MM_editCmd = Server.CreateObject ("ADODB.Command")
    MM_editCmd.ActiveConnection = MM_connAdmin_STRING
    MM_editCmd.CommandText = "INSERT INTO tblMembers (FirstName, LastName, Email, HomePhone, CellPhone, Address, City, [State], Zip, MembType, MembLevel, Cameras, ShowAll, ShowEmail, ShowHomePhone, ShowCellPhone, ShowAddress, ShowCamera, ShowNameOnly, Username, Pass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)" 
    MM_editCmd.Prepared = true
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param1", 202, 1, 255, Request.Form("FirstName")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param2", 202, 1, 255, Request.Form("LastName")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param3", 202, 1, 255, Request.Form("Email")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param4", 202, 1, 25, Request.Form("HomePhone")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param5", 202, 1, 25, Request.Form("CellPhone")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param6", 202, 1, 255, Request.Form("Address")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param7", 202, 1, 255, Request.Form("City")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param8", 202, 1, 50, Request.Form("State")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param9", 202, 1, 25, Request.Form("Zip")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param10", 202, 1, 25, Request.Form("MembType")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param11", 202, 1, 35, Request.Form("MembLevel")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param12", 203, 1, 536870910, Request.Form("Cameras")) ' adLongVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param13", 5, 1, -1, MM_IIF(Request.Form("ShowAll"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param14", 5, 1, -1, MM_IIF(Request.Form("ShowEmail"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param15", 5, 1, -1, MM_IIF(Request.Form("ShowHomePhone"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param16", 5, 1, -1, MM_IIF(Request.Form("ShowCellPhone"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param17", 5, 1, -1, MM_IIF(Request.Form("ShowAddress"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param18", 5, 1, -1, MM_IIF(Request.Form("ShowCamera"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param19", 5, 1, -1, MM_IIF(Request.Form("ShowNameOnly"), 1, 0)) ' adDouble
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param20", 202, 1, 50, Request.Form("Username")) ' adVarWChar
    MM_editCmd.Parameters.Append MM_editCmd.CreateParameter("param21", 202, 1, 50, Request.Form("Pass")) ' adVarWChar
    MM_editCmd.Execute
    MM_editCmd.ActiveConnection.Close
  End If
End If
%>


<%
Const cdoSendUsingPickup = 1
Const cdoSendUsingPort = 2
Const cdoAnonymous = 0 
Const cdoBasic = 1 
Const cdoNTLM = 2 
Set oMail = CreateObject("CDO.Message") 

oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2 
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpserver") = "mail.domain.org"
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate") = cdoBasic
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendusername") = "webmaster@domain.org"
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/sendpassword") = "domain!"
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpusessl") = False
oMail.Configuration.Fields.Item _
("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 60
oMail.Configuration.Fields.Update 

oMail.Sender = "webmaster@domain.org"
oMail.To = "info@domain.org"
oMail.Bcc = "johndoe@domain.com; johndoe@domain.com; johndoe@domain.net"

oMail.Subject = "Charlotte Camera Club Membership"

oMail.HTMLBody = "<font size='2' face='Verdana, Arial, Helvetica, sans-serif'>"

oMail.HTMLBody = oMail.HTMLBody + "First Name: <b>"& request.form("FirstName")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Last Name: <b>"& request.form("LastName")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Email: <b>"& request.form("Email")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Home Phone: <b>"& request.form("HomePhone")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Cell Phone: <b>"& request.form("CellPhone")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Address: <b>"& request.form("Address")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "City: <b>"& request.form("City")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "State: <b>"& request.form("State")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Zip: <b>"& request.form("Zip")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Membership Type: <b>"& request.form("MembType")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "You consider yourself a: <b>"& request.form("MembLevel")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "What camera(s) do you use now?  <b>"& request.form("Cameras")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "What contact information would you like to include in the Members' Directory?<br>"
if request.form("ShowAll") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>All Info</b><br>"
end if
if request.form("ShowEmail") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>Email</b><br>"
end if
if request.form("ShowHomePhone") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>Home Phone</b><br>"
end if
if request.form("ShowCellPhone") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>Cell Phone</b><br>"
end if
if request.form("ShowAddress") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>Mailing Address</b><br>"
end if
if request.form("ShowCamera") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>Camera Type</b><br>"
end if
if request.form("ShowNameOnly") = "Yes" then
oMail.HTMLBody = oMail.HTMLBody + "<b>None - Name Only</b><br>"
end if
oMail.HTMLBody = oMail.HTMLBody + "Your Login:  <b>"& request.form("Username")&"</b><br>"
oMail.HTMLBody = oMail.HTMLBody + "Password:  <b>********</b><br>"

oMail.HTMLBody = oMail.HTMLBody + "</font>"
	
oMail.Send 

Set oMail = Nothing 
Set oMailConfig = Nothing 
%>
<% end if %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/mainCamClub.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Charlotte Camera Club</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript1.2" type="text/javascript" src="../mm_css_menu.js"></script>
<link rel="stylesheet" type="text/css" href="../header.css">
<link rel="stylesheet" type="text/css" href="../global.css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
</head>
<body>
<div align="center">
<!--#include file="header.asp" -->
<table width="1020" border="0" align="center" cellpadding="0" cellspacing="0">    
	<tr>
		<td align="left" valign="top" background="../images/CharlotteCameraClub_02.gif">        
        <div id="innercontent">
        <!-- InstanceBeginEditable name="text" -->
        
      	<h1>Charlotte Camera Club Membership</h1>
      	<p><strong>One moment please... </strong></p>
      	<p>&nbsp;</p>
      	<p>&nbsp;</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="7D59EPZE7LLZS">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Charlotte Camera Club Membership">
<input type="hidden" name="amount" value="<%= request.form("Dues") %>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="cn" value="Add special instructions to the seller:">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://domain.com">
<input type="hidden" name="cancel_return" value="http://domain.com/Renew.asp">
<input type="hidden" name="tax_rate" value="0.000">
<input type="hidden" name="shipping" value="0.00">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<script language="JavaScript">document.forms[0].submit();</script>
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

        <!-- InstanceEndEditable -->
      	</div>
      	</td>
	</tr>
</table>
<!--#include file="footer.asp" -->
</div>
</body>
<!-- InstanceEnd --></html>
