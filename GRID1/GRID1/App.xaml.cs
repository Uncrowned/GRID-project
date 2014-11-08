using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Windows;

namespace GRID1
{
	/// <summary>
	/// Interaction logic for App.xaml
	/// </summary>
	public partial class App : Application
	{
        protected override void OnStartup(StartupEventArgs e)
        {
            base.OnStartup(e);
            userInfo user = userInfo.Instance();
        }
        protected override void OnExit(ExitEventArgs e)
        {
            base.OnExit(e);
            //MessageBox.Show("Do you want to exit programm?", MainWindow.Title, MessageBoxButton.YesNo, MessageBoxImage.Question, MessageBoxResult.No);
        }
	}
}