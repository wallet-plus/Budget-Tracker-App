import 'dart:io';
import 'package:flutter/material.dart';
import 'package:flutter_webview_pro/webview_flutter.dart';

void main() => runApp(App());

class App extends StatelessWidget {
  const App({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        body: Body(),
      ),
    );
  }
}

class Body extends StatelessWidget {
  const Body({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Container(
      child: Web(),
    );
  }
}

class Web extends StatefulWidget {
  const Web({Key? key}) : super(key: key);

  @override
  _WebState createState() => _WebState();
}

class _WebState extends State<Web> {
  @override
  void initState() {
    super.initState();
    // Enable hybrid composition.
    if (Platform.isAndroid) WebView.platform = SurfaceAndroidWebView();
  }

  @override
  Widget build(BuildContext context) {
    return SafeArea(
      // This will leave space for system overlays like the status bar
      child: const WebView(
        initialUrl: "https://secure.walletplus.in",
        javascriptMode: JavascriptMode.unrestricted,
        // userAgent: "random",
      ),
    );
  }
}
