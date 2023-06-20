import 'package:flutter/material.dart';
import 'package:mobile/providers/articles_provider.dart';
import 'package:provider/provider.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<StatefulWidget> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp>{
  @override
  void initState() {
    super.initState();
    Provider.of<ArticlesProvider>(context, listen:false).fetchArticles();
  }

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