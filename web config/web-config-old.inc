<?xml version="1.0" encoding="UTF-8"?>
<configuration>
  <appSettings>
    <add key="MM_CONNECTION_HANDLER_connFestNews" value="default_oledb.htm" />
    <add key="MM_CONNECTION_STRING_connFestNews" value="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=h:\root\home\rdavis-001\www\db\fesnews.mdb" />
    <add key="MM_CONNECTION_DATABASETYPE_connFestNews" value="OleDb" />
    <add key="MM_CONNECTION_SCHEMA_connFestNews" value="" />
    <add key="MM_CONNECTION_CATALOG_connFestNews" value="" />
    <add key="MM_CONNECTION_HANDLER_connCalendar" value="default_oledb.htm" />
    <add key="MM_CONNECTION_STRING_connCalendar" value="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=h:\root\home\rdavis-001\www\db\MeckMedCalendar.mdb;Persist Security Info=False" />
    <add key="MM_CONNECTION_DATABASETYPE_connCalendar" value="OleDb" />
    <add key="MM_CONNECTION_SCHEMA_connCalendar" value="" />
    <add key="MM_CONNECTION_CATALOG_connCalendar" value="" />
    <add key="MM_CONNECTION_HANDLER_connANPA" value="default_oledb.htm" />
    <add key="MM_CONNECTION_STRING_connANPA" value="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=h:\root\home\rdavis-001\www\db\ANPA.mdb;Persist Security Info=False" />
    <add key="MM_CONNECTION_DATABASETYPE_connANPA" value="OleDb" />
    <add key="MM_CONNECTION_SCHEMA_connANPA" value="" />
    <add key="MM_CONNECTION_CATALOG_connANPA" value="" />
    <add key="MM_CONNECTION_HANDLER_connNCTA" value="default_oledb.htm" />
    <add key="MM_CONNECTION_STRING_connNCTA" value="Provider=Microsoft.Jet.OLEDB.4.0;Data Source=h:\root\home\rdavis-001\www\db\ncta.mdb;Persist Security Info=False" />
    <add key="MM_CONNECTION_DATABASETYPE_connNCTA" value="OleDb" />
    <add key="MM_CONNECTION_SCHEMA_connNCTA" value="" />
    <add key="MM_CONNECTION_CATALOG_connNCTA" value="" />
    <add key="WebXelUploadLiteRegEmail" value="jeff@jeffpblues.com" />
    <add key="WebXelUploadLiteRegKey" value="4uwN1pGb6/zYxXQXnbi4dh0TG2eO/vBK" />
    <add key="WebXelAuthenticationRegEmail" value="jeff@jeffpblues.com" />
    <add key="WebXelAuthenticationRegKey" value="YINi82RuUd775kgp+FRbw7/BgwhJ8gaM" />
  </appSettings>
  <system.web>
    <customErrors mode="Off" />
  </system.web>
  <system.webServer>
    <rewrite>
      <rules>
			<rule name="WordPress: http://domain.com1" patternSyntax="Wildcard">
				<match url="*" />
					<conditions>
						<add input="{REQUEST_FILENAME}" matchType="IsFile" negate="true" />
						<add input="{REQUEST_FILENAME}" matchType="IsDirectory" negate="true" />
					</conditions>
				<action type="Rewrite" url="index.php" />
			</rule></rules>
    </rewrite>
        <httpErrors errorMode="Detailed" />
        <caching enabled="true" />
  </system.webServer>
</configuration>
