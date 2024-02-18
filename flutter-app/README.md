# walletplus

A new Flutter project.

## Getting Started

This project is a starting point for a Flutter application.

A few resources to get you started if this is your first Flutter project:

- [Lab: Write your first Flutter app](https://docs.flutter.dev/get-started/codelab)
- [Cookbook: Useful Flutter samples](https://docs.flutter.dev/cookbook)

For help getting started with Flutter development, view the
[online documentation](https://docs.flutter.dev/), which offers tutorials,
samples, guidance on mobile development, and a full API reference.

### Check Flutter 
    flutter --version

### Webview:
- open pubspec.yaml  add webview_flutter: ^2.0.9 under dependencies
- [Webview](https://pub.dev/packages/webview_flutter/versions)
- import 'package:webview_flutter/webview_flutter.dart';
- flutter pub get
- Enable permission android\app\src\main\AndroidManifest.xml
    <uses-permission android:name="android.permission.INTERNET"/>

### Icon Change:
[Generate Location ](https://www.appicon.co/#image-sets)

### Remove Debugger:
    MaterialApp(
    debugShowCheckedModeBanner: false
    )

 ### Reference:
 - [Setup Flutter and Visual Studio Code In Windows](https://www.youtube.com/watch?v=5izFFbdHnWY)
 - [Install Android Studio on Windows also Setup Flutter](https://www.youtube.com/watch?v=_SFCF7gMEAg)
 - [WebView In Flutter For Beginners](https://www.youtube.com/watch?v=5u3pZZ6uvDo)
 


### Build Release:
- flutter clean
- flutter build apk
- flutter build apk --release
- Build will be generated at D:\WalletPlus-Flutter-App\walletplus\build\app\outputs\flutter-apk\

