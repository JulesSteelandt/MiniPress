import 'package:flutter/material.dart';

class MiniPressApp extends StatelessWidget {
  const MiniPressApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MiniPress App',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
        useMaterial3: true,
      ),
      home: Scaffold(
        appBar: AppBar(
          backgroundColor: Theme.of(context).colorScheme.inversePrimary,
          title: const Text('MiniPress App'),
        ),
        body: const Text('Bienvenue !')
      ),
    );
  }
}