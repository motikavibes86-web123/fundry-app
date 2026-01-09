import 'package:flutter/material.dart';

void main() {
  runApp(FundyApp());
}

/// FundyApp: Where fundis meet clients and magic happens ✨
class FundyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Fundy – Fundi wako, papo hapo',
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: Scaffold(
        appBar: AppBar(
          title: Text('Fundy – Let’s fix things! 🔧'),
        ),
        body: Center(
          child: Text(
            'Welcome to Fundy! Book a fundi, chill, repeat 😎',
            textAlign: TextAlign.center,
          ),
        ),
      ),
    );
  }
}
  
